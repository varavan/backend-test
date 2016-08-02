# Java implementation caravelo test

As long as the architechture of previous project was good enought, this java implementation has same architecture as `php application` so makes it easier to review so develop it. And demostrates how DDD is flexible against infrastructure changes


## Considerations

Java is not my main language, I  used java for small cloud solutions with AWS. I never used it as a web server so spring is somehow new to me. But I consider myself as a fanatic learning, with a SOLID knowleadge about software engineering so I am able to write for any enviorment, besides some time  to learn tricky points of a language.

There are some API contracts broken because of the `router` configuration.Routes are:

- /surveys
- /survey?slug=$SLUG


## Tests 

This project is lacking some basic tests, if it was a production tests I would propose at least all the app domain tested. I did not wrote tests because I am not used to Spring so my tests were not good enought. I prefer to explain them rather than delivering poor tests:


- Test that controllers respons 200 and check response
- Test All Busines Cases
- Test Spring container
- Test utils like `Slugify`
- Test survey infrastructure
- Test suvey service
- Test Json Transformer
