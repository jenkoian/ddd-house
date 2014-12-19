DDD House
=========

This repository is used to 'build a house with DDD'. It's a means of getting my head around a few concepts I've been learning recently. Such as the following:

* [Modelling by example](http://everzet.com/post/99045129766/introducing-modelling-by-example)
* [Domain-Driven-Design](http://en.wikipedia.org/wiki/Domain-driven_design)
* Commands and Handlers
* Command Bus
* Domain Events
* [Hexagonal Architecture](http://alistair.cockburn.us/Hexagonal+architecture)
* BDD (using Behat & PHPSpec)
* [Named constructors](http://verraes.net/2014/06/named-constructors-in-php/)
* [Value Objects](http://verraes.net/2014/06/named-constructors-in-php/)

The biggest thing I aim to achieve is the separation of layers. Using modelling by example to work from the middle out. Cleanly separating the domain from the rest of the application. 

I aim to do this iteratively with each stage of my work in a separate branch. For example, version1 branch may be just setting up some basic behat features through to a fully featured domain layer, with infrastructure supporting a front end that communicates to the domain.

How to use this repo
--------------------

View each branch along with the notes in the commit message to see what each commit adds.

* [Version0](#)
* [Version1](#)
* [Version2](#)
* [Version3](#)
* [Version4](#)
* [Version5](#)
* [Version6](#)
* [Version7](#)
* [Version8](#)
* [Version9](#)
* [Version10](#)
* [Version11](#)
* [Version12](#)
* [Version13](#)
* [Version14](#)
* [Version15](#)
* [Version16](#)
* [Version17](#)
* [Version18](#)
* [Version19](#)
* [Version20](#)
* [Version21](#)
* [Version22](#)
* [Version23](#)
* [Version24](#)
* [Version25](#)

Inspiration
-----------

As mentioned the blog post by Everzet on ['Modelling by example'](http://everzet.com/post/99045129766/introducing-modelling-by-example) was a big inspiration behind this kind of approach. Definitely read it. Funnily enough, he has been working on a similar repository which I wasn't aware of until recently called ['pick-my-talks'](https://github.com/MarcelloDuarte/pick-my-talks). It doesn't cover things like commands and handler but is probably a better example of modelling by exmaple than this, so definitely recommend checking that out also.

Other sources of inspiration include:

* This excellent talk by Ross Tuck: [Models and Service Layers](https://www.youtube.com/watch?v=3uV3ngl1Z8g)

TODO
----

* Add acceptance tests as a next step.
* Look into possibility of adding some kind of persistence of house state.
* Rebase commits to add useful nots to each branch.
* Add more inspiration links to this README.
* Add links to version branches to this PR.
* Migrate repo to git.
* Write blog post.

