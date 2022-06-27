1 - Navegue para /lib/systemd/system em seu terminal e abra o arquivo docker.service:
nano /lib/systemd/system/docker.service
2 - Encontre a linha que começa com ExecStart e adiciona -H=tcp://0.0.0.0:2375 para torná-la parecida com:
ExecStart = /usr/bin/dockerd -H = fd:// -H=tcp://0.0.0.0:2375
3 - Salve o arquivo modificado
4 - Recarregue o docker daemon:
systemctl daemon-reload
5 - Reinicie o container:
sudo service docker restart
Teste se está funcionando usando este comando, se tudo está bem abaixo do comando deve retornar um JSON:
curl http://localhost:2375/images/json
Para testar remotamente, use o nome do PC ou endereço IP do Docker Host
