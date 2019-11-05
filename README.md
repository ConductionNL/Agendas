# About this component

![Repo Status](https://img.shields.io/badge/status-concept-lightgrey.svg?style=plastic)

The calendar service aims to provide both calendar and bookings functionality to other common ground applications. As such a Calendar object is always on the inverse side of a relation. E.g. a person, resource or location can have a calendar but a calendar doesn�t have an owner. 
Keeping in form with international standardization calendars are based on the [schema.org]( https://schema.org/) [Schedule](https://schema.org/Schedule) and [Event](https://schema.org/Event) objects. They are however extend with functionality from CalDav[](https://en.wikipedia.org/wiki/CalDAV), [ICalendar](https://en.wikipedia.org/wiki/ICalendar) and [Google�s Calendar api](https://developers.google.com/calendar/quickstart/php) to provide and complete API experience. 

## Documentation

- [Development roadmap](ROADMAP.md)
- [How to contribute](CONTRIBUTING.md)
- [Installation of this component](INSTALLATION.md)
- [Making commonground components](TUTORIAL.md)
- [Securing this component](SECURITY.md)
- [Design considerations](DESIGN.md)

A hosted version of the OAS documentation and an demo version of the API can be found on http://vrc.zaakonline.nl

## Features
This repository uses the power of the [commonground proto component](https://github.com/ConductionNL/commonground-component) provide common ground specific functionality based on the [VNG Api Strategie](https://docs.geostandaarden.nl/api/API-Strategie/). Including  

* Build in support for public API's like BAG (Kadaster), KVK (Kamer van Koophandel)
* Build in validators for common dutch variables like BSN (Burger service nummer), RSIN(), KVK(), BTW()
* AVG and VNG proof audit trails, Wildcard searches, handling of incomplete date's and underInvestigation objects
* Support for NLX headers
* And [much more](https://github.com/ConductionNL/commonground-component) .... 

## Credits
This component was created by conduction (https://www.conduction.nl/team) for the municipality of [utrecht](https://www.utrecht.nl/). But based  on the [common ground proto component](https://github.com/ConductionNL/commonground-component). For more information on building your own common ground component please read the [tutorial](https://github.com/ConductionNL/commonground-component/blob/master/TUTORIAL.md).  


[![Utrecht](https://raw.githubusercontent.com/ConductionNL/agendascomponent/master/resources/logo-utrecht.svg?sanitize=true "Utrecht")](https://www.utrecht.nl/)
[![Conduction](https://raw.githubusercontent.com/ConductionNL/agendascomponent/master/resources/logo-conduction.svg?sanitize=true "Conduction")](https://www.conduction.nl/)

## License
Copyright � [Gemeente Utrecht](https://www.utrecht.nl/)  2019

[Licensed under the EUPL](LICENCE.md)





