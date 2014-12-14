VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.ssh.username="root"

  config.vm.provider "docker" do |d|
    d.name = "docker-symfony"
    d.build_dir = "."
    d.ports = [
        "80:80",
        "27017:27017"
    ]
    d.vagrant_vagrantfile = "proxy/Vagrantfile.proxy"
    d.volumes = ["/vagrant/:/var/www/docker-symfony:rw", "/data/db/:/data/db:rw"]
  end
end
