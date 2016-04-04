# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.define 'twitter' do |node|
	node.vm.hostname = 'twitter.d'
	config.hostsupdater.aliases = ['twitter.d']
	node.vm.network "private_network", ip: "192.168.15.10", lxc__bridge_name: 'vlxcbr1'
  	node.vm.box = "fgrehm/trusty64-lxc"

	node.vm.box_url = "https://vagrantcloud.com/fgrehm/trusty64-lxc"

	node.vm.synced_folder "silex-twitter", "/var/www/twitter"
	node.vm.provision "ansible" do |ansible|
		ansible.playbook = "provisioning/dev.yml"
	end
    end

end
