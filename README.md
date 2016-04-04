# Silex with twitter

This is example how to work with Twitter API with Silex Framework

## API
Application implements three endpoints
- ```/```
will respond with "Try /hello/:name" as text
- ```/hello/{username}```
will respond with "Hello {username}" as text
- ```/histogram/{username}```
will respond with a JSON structure displaying the tweets per hour of the day

## Run an example
You need vagrant, ansible and LXC (for Linux) or VirtualBox (for MacOS or Windows) installed to run this example.
### Linux
I provide instructions how to run example in Linux (with apt package manager):
- clone repository to desired location
```git clone git@github.com:letchik/silex-twitter.git .```
- change current directory ```cd silex-twitter```
- ```sudo apt-get install vagrant ansible lxc```
- ```vagrant plugin install vagrant-lxc```
- ```vagrant plugin install vagrant-hostsupdater```
- check config in Vagrantfile, you may need to change ip in line 

`node.vm.network "private_network", ip: "192.168.15.10", lxc__bridge_name: 'vlxcbr1'`
- ```vagrant up```
- open [url](http://twitter.d) in your browser

### Windows and MacOs
Sorry, I have no Windows or MacOs machine right now, so I can't describe deployment process

## Notices
1. For every endpoint where {username} is used username should follow Twitter username restrictions:
    - only alphanumeric and underscore symbols
    - maximum length is 15.
2. I use Twitter Application-only authentication (see [docs](https://dev.twitter.com/oauth/application-only)) in case of I don't know the case of use this api, and there was no information in task regarding user authentication
3. I use SessionServiceProvider to store twitter api key, in case that I don't have any permanent repository to store Twitter API key and don't have user authentication. It's temporary solution; final solution depends on further requirements
4. As Twitter Api returns tweet creation time in UTC, I suppose to get actual hour based on timezone at when user was registered. Just for fun :) It's not true hour, but there truth is out there :)
5. Finally, I did everything based on development environment. This means that all development dependencies will be installed by ansible as well. There is no production mode yet. 

## Tests
You can run tests either on your local or inside virtual machine. 
To run tests on your local you should install composer and run composer install inside of working directory.
To run tests in VM do nothing, but ```vagrant ssh``` and ```cd /var/www/twitter```
After that just run ```vendor/bin/phpunit -c phpunit.xml.dist```
 
