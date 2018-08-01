# Bota Pressão
É um Plugin para o gerenciamento do WordPress que permite organizar informações sobre políticos e disponibiliza-las de forma facilitada, de forma que tenha utilidade tanto para fornecer informações qualificadas para o cidadão como para pressioná-los para causas específicas.
Neste momento o plugin está sendo desenvolvido com foco no projeto #ditoefeito, que mapeou todos os votos sobre o Impeachment de Dilma Rouseff e as ocorrências judiciais de cada parlamentar. 

https://342agora.org.br/

![GitHub](https://img.shields.io/github/license/ForaDoEixo/botapressao.svg)
[![chatroom icon](https://patrolavia.github.io/telegram-badge/chat.png)](https://t.me/joinchat/AEg1X1NZqgligtfGV7x3Og)

# Screenshot
![Screenshot](./screenshots/0.png)
![Screenshot](./screenshots/1.png)
![Screenshot](./screenshots/2.png)


No mês de setmbro de 2016 o plugin passou por modificações, permitindo inserir todos os deputados atuais utilizando o webservice da camara, e também ele conta com a possibilidade de gerenciar não só apenas politcos mas qualquer tipo de agente público. O plugin atualmente tem forte ligação com o tema divi. Para qual já contamos com 7 modulos. Para é necessário utilizar o sub-tema do divi:

https://github.com/redelivre/wp-divi-delibera

# Inserindo novos campos input, select e textarea

```
function get_metas()´
{
  return array(
        array ( 
        'label' => 'Partidos', 
        'slug'=>'' ,
        'info' => 'Nenhum Partido Encontrado', 
        'html' => array (
                        'tag'=> 'select', 
                        'options' => array (
                           array ( 'value' => 'PMDB' , 'content' => 'PARTIDO DO MOVIMENTO DEMOCRÁTICO BRASILEIRO' ) ,
                           array ( 'value' => 'PTB' , 'content' => 'PARTIDO TRABALHISTA BRASILEIRO' ) 
                          )
                        ) 
        ),
  ); 
}
```
