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
I provide instructions how to run example in Linux (with apt package manager):
- clone repository to desired location
```git clone git@github.com:letchik/silex-twitter.git .```
- change current directory ```cd silex-twitter```
- ```sudo apt-get install vagrant ansible lxc```
- ```vagrant plugin install vagrant-lxc```
- check config in Vagrantfile, you may need to change ip in line 

`node.vm.network "private_network", ip: "192.168.15.10", lxc__bridge_name: 'vlxcbr1'`
- ```vagrant up```
- open [url](http://twitter.d) in your browser

## Notices
1. For every endpoint where {username} is used username should follow Twitter username restrictions:
    - only alphanumeric and underscore symbols
    - maximum length is 15.
2. I use Twitter Application-only authentication (see [docs](https://dev.twitter.com/oauth/application-only)) in case of I don't know the case of use this api, and there was no information in task regarding user authentication
3. I use SessionServiceProvider to store twitter api key, in case that I don't have any permanent repository to store Twitter API key and don't have user authentication. It's temporary solution; final solution depends on further requirements
