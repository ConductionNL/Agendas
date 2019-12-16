# General

The calendar component is in the core originally based upon the standards for [Events](http://schema.org/Event) and [Schedules](http://schema.org/Schedule) of Schema.org. However, because this is aimed at commercial events such as concerts, readings and other events, we had to extend our base set of standards with the [iCalendar]( [https://tools.ietf.org/html/rfc5545](https://tools.ietf.org/html/rfc5545)) standard. Resulting in the following entities:

- Calendar
- To-do
- Freebusy
- Journal
- Alarm

The standard also poses for a timezone-entity, however, as this is something that can be solved otherwise the timezone entity is replaced by a property in the calendar entity.

All entities have at least a name and description, as described for the [Thing]() class of Schema.org.

## Calendar

The calendar entity has the following properties.

| Property | Description | Type | Relationship |
| --- | --- | --- | --- |
| id | Uuid identifier of the calendar | string |   |
| name | Name of the calendar | string |   |
| description | Description of the calendar | string |   |
| timezone | The time zone of the calendar | string |   |
| prodid | The software used to create the calendar | string |   |
| schedules | Schedule-entities in this calendar | Schedule | OneToMany |
| events | Event-entities in this calendar | Event | OneToMany |
| todos | Todo-entities in this calendar | Todo | OneToMany |
| freebusys | Freebusy-entities in this calendar | FreeBusy | OneToMany |

This entity does not implement the following properties from the iCalendar standard.

- calscale: we assumed that for this calendar component the use cases for other calendar scales than Gregorian are out of scope
- method: this property is not needed due to the scope of our component and the way it is implemented using a REST-API.
- version: This property is not needed for the internal working of the component, and will be exported with the ics

The properties that are not in the iCalendar standard are exported with the prefix x- when exporting to ics files.

## Event

The event entity is an entity to describe appointments, meetings and other events in a calendar.

The event entity implements the following properties:

| Property | Description | Type | Relationship |
| --- | --- | --- | --- |
| id | Uuid identifier of the event | string |   |
| name | Name of the event | string |   |
| description | Description of the event | string |   |
| startDate | Date and time the event starts (dstart in ics) | DateTime |   |
| endDate | Date and time the event ends (dend in ics) | DateTime |   |
| duration | Duration of the event (automated) | Duration |   |
| contact | Contact person for the event (url to contact component) | url |   |
| class | The security class of the event. Choose from &quot;PUBLIC&quot;, &quot;PRIVATE&quot; or &quot;CONFIDENTIAL&quot; | string |   |
| created | Date and time the event was created | DateTime |   |
| lastModified | Date and time of the last modification | DateTime |   |
| geo | Global position (coordinate) of the event | [float, float] |   |
| location | Human readable reference of the event location | url |   |
| organizer | Organiser of the event (url to contact component) | url |   |
| priority | Priority of the event | int {1-9} |   |
| status | Status of the event. Choose from &quot;tentative&quot;, &quot;confirmed&quot; and &quot;cancelled&quot; | string |   |
| summary | Short description of the event | string |   |
| seq | Version number of the event (automated) | int |   |
| url | Url of the event (automated) | string |   |
| attendees | Urls of the attendees of the event (contact component) | url[] |   |
| attachments | Urls of the attachments of the event | url[] |   |
| categories | Urls of the categories the event belongs to | url[] |   |
| comments | Urls of the comments that belong to the event | url[] |   |
| related | Related events | Event[] | ManyToMany |
| resources | Resources for this event | Resource[] | OneToMany |
| calendar | The calendar the event belongs to | Calendar | ManyToOne |
| schedule | Schedule the event belongs to | Schedule | ManyToOne |
| alarms | Alarms belonging to this event | Alarm[] | OneToMany |

This entity does not implement the following properties:

- exrule: this property of the iCalender standard is deprecated
- dtstamp: this property can is replaced by the &quot;created&quot; and &quot;last-mod&quot; properties, and hence can be exported from those
- rstatus: the request status should not be part of the object, but the status can be given during the ics export.
- recurid: the recurrence of events is handled by the schedule, of which the id is given.
- exdates: this property is handled by the Schedule-class, and can hence be retrieved recursively on export to ics

## Todo

The Todo entity extends the event property, with the following differences:

Properties from the event entity that are not in the todo entity:

- transp

The following property in the Todo entity has to be named differently when exporting to iCalender files:

- endDate: this entity has to be exported as due instead of dend

The following properties are in the Todo entity that are not in the event property:

| Property | Description | Type |
| --- | --- | --- |
| completed | The date and time a Todo was completed | DateTime |
| percentageDone | The percentage the Todo is completed | int |

## Freebusy

The Freebusy entity describes times that people are not available but also not have appointments.

The Freebusy entity only implements the following properties described in previous entities:

- id
- url
- description: part of &quot;Thing&quot;, so always present
- attendee
- comment
- contact
- startDate
- endDate
- duration
- organizer

And the following unique property:

| Property | Description | Type |
| --- | --- | --- |
| freebusy | determination of the type of freebusy, choose from &quot;BUSY-UNAVAILABLE&quot; and &quot;FREE&quot;. Together with startDate and duration exported as freebusy-property to ics. | string |

## Journal

The Journal entity is used to note down journals on the calendar.

The Journal entity has most properties in common with the Event property, but does not implement the following properties:

- geo
- location
- resources
- schedule
- alarms

We added a property &#39;events&#39; referring to the event entity, in order to describe what journal is related to what event.

## Alarm

The Alarm entity is used to describe alarms for Events and Todos in the calendar.

The Alarm entity has the following properties that are used in other entities:

- id
- name
- description
- summary

And the following unique properties:

| Property | Description | Type | Relationship |
| --- | --- | --- | --- |
| action | The action of the alarm. Choose from &quot;AUDIO&quot;, &quot;DISPLAY&quot;, &quot;EMAIL&quot; and &quot;PROCEDURE&quot; | string |   |
| trigger | the time the alarm should trigger relative to the start time of the related event | Duration |   |
| duration | the time until the alarm repeats | Duration |   |
| repeat | the number of times the alarm repeats | int |   |
| event | the event the alarm relates to (mutual exclusive with todo) | Event | ManyToOne |
| todo | the todo the alarm relates to (mutual exclusive with event) | Todo | ManyToOne |

## Schedule

This entity is used to keep track of recurring events, journals or todos.

The Schedule entity has the following properties:

- id
- name
- description

| Property | Description | Type | Relationship |
| --- | --- | --- | --- |
| byDay | The day of the week the event is recurring | int |   |
| byMonth | The number of the month the events recurs in | int |   |
| byMonthDay | The day of the month the events recurs on | int |   |
| repeatCount | The number of times the events are repeated | int |   |
| repeatFrequency | The frequency the events recur in | int |   |
| exceptDates | The dates that are excluded from the schedule | DateTime[] |   |
| events | The Events in the schedule | Event[] | OneToMany |
| todos | The Todos in the schedule | Schedule[] | OneToMany |
| freeBusys | The FreeBusy-entities in the schedule | FreeBusy[] | OneToMany |
| calendar | The calendar the schedule belongs to | Calendar | ManyToOne |

## Resource

The resource entity describes resources that can be needed for an event. E.g. a car, room or computer.

The resource entity has the following properties:

- id
- name
- description
