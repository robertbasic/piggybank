# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "fedora25"
  config.vm.box_url = "https://download.fedoraproject.org/pub/fedora/linux/releases/25/CloudImages/x86_64/images/Fedora-Cloud-Base-Vagrant-25-1.3.x86_64.vagrant-virtualbox.box"

  config.vm.network "private_network", ip: "11.11.11.100"

  config.ssh.forward_agent = true

  config.vm.synced_folder "./", "/var/www", type: "nfs"

  config.vm.boot_timeout = 9000

  config.vm.provider "virtualbox" do |vb|
    # Boot with headless mode
    # vb.gui = true

    # Use VBoxManage to customize the VM. For example to change memory:
    vb.customize ["modifyvm", :id, "--memory", "2048"]
  end

  config.vm.provision "ansible" do |ansible|
    ansible.playbook = "provisioning/vagrant.yml"
  end

end
