confADM
====

confADM is a project developed since 2012 as the main administrative system behind a large conference that takes place in the [Institute of Physics of São Carlos](http://www.ifsc.usp.br/) (University of São Paulo), "Semana do Instituto de Física de São Carlos" (SIFSC). After this period of development, we wanted to share the source code with everyone interested in learning a bit from all this work. We also believe that the SIFSC could benefit from this code becoming public, as much more people would be able to contribute to it and create an awesome project together. In other words, this project could become a wonderful project maintained by the community to the community. The core system was successfully used in at least 8 different conferences (in addition to the four chapters of SIFSC).

Because this project, as is right now, is highly focused on the community around the Institute of Physics of São Carlos, most of its documentation will be written in Portuguese. This introductory paragraph intends to make a general introduction to anyone who might appear here. If you have questions, do not hesitate contacting the developers.


Licence
---

We have shared all of our work under a somewhat permissive license, the GNU
General Public license, version 3 from 29 June 2007. It is fully available in
the [LICENSE](https://github.com/VandroiyLabs/confADM/blob/master/LICENSE) file.
Should you benefit from this code, we would highly appreciate if you could star
our repository.


Ideia geral do sistema
---

O sistema funciona em 3 partes básicas e interconectadas: _user_, _adm_ e _referee_. A ideia foi seguir o padrão de desenvolvimento _Model–View–Controller_, e para tal dividimos todo o desenvolvimento em três partes:

* Definições de classes (model)
* Páginas, formulários, e javascripts (view)
* Scripts _action_ (controller)

Todas as classes estão definidas na pasta _user/classes/_.

Dependências
----

A versão atual deste software assume as seguintes bibliotecas:

* PHP 5.6
* PHPMailer
* MPDF54
* MariaDB


Configurações necessárias
---

A seguir, algumas das configurações necessárias com respeito ao banco de dados e e-mails.

* Detaches para configure e-mail estão no arquivo _email_functions.php_
* Conexão com o banco de dados deve ser configurada no arquivo _class.conexao.php_, onde login e senha são definidos.
