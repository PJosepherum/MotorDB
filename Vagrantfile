VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "phalconbox"
    config.vm.box_url = "https://s3-eu-west-1.amazonaws.com/phalcon/phalcon125-apache2-php54-mysql55.box"

    # Port map
    config.vm.network "forwarded_port", guest: 80,   host: 8080
    config.vm.network "forwarded_port", guest: 3306, host: 3307

    # Private network
    config.vm.network "private_network", ip: "10.3.3.7"

    # VirtualBox spec
    config.vm.provider "virtualbox" do |v|
        v.gui = false

        v.customize ["modifyvm", :id, "--memory", "1024"]
        v.customize ["modifyvm", :id, "--cpuexecutioncap", "95"]
        v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        v.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    end

    # Provision deps
    config.vm.provision "shell", path: "./dep/provision.sh"

end