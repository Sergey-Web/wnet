 Необходимо реализовать  класс, который  будет использоваться для печати документов. От Вас требуется написать функционал по получению данных.  На вход передается id_contract или number, по которому нужно найти привязанного клиента и привязанные сервисы. Далее полученную информацию отобразить в шаблоне(приведён ниже). На выполнения задания дается 2 дня.

У нас есть 3 таблицы в mysql:
obj_contracts;
obj_customers;
obj_services.

Структура obj_contracts следующая:
 id_contract ( int 11  IA );
id_customer ( int 11 );
number ( varchar 100 );
date_sign ( date );
staff_number( varchar 100 ).

Структура obj_customers следующая:
 id_customer( int 11  IA );
name_customer( varchar 250 );
company ( enum('company_1','company_2','company_3') ).

Структура obj_services следующая:
 id_service( int 11  IA );
id_contract(  int 11 );
title_service( varchar 250 );
status ( enum('work','connecting','disconnected') ).

Связанны таблицы следующим образом:
 `obj_customers`.`id_customer` = `obj_contracts`.`id_customer`,
 ` obj_services`.`id_contract` = `obj_contracts`.`id_contract`.

Тоесть у клиента может быть несколько договоров, а в каждом договоре несколько сервисов.

База данных ― 1-2 запроса для получения данных.
Подключение к БД через mysqli.
Для подключения использовать конструктор.
 Функция вывода должна выводить данные в  карточке ( шаблон карточки в виде кода ниже, шаблон записать в отдельный файл  «вьюшку». 
 Использование «фабрики», которая будет проверять на существования для данного клиента такого объекта  и возвращать уже существующий обьект по этому клиенту, а не создавать новый. В текущем задании так как Вы будете отправлять только поиск одного клиента — то будет все время создаваться новый обьект, но я хотел бы увидеть фабрику, так как если б передавался массив клиентов, и могли б клиенты повторяться и было б не совсем корректно создавать заново обьект и с новым обьектом работать.
Сделать в виде формы — поле для поиска, checkbox с выбором статуса договора('work','connecting','disconnected'), кнопка «отправить». При помощи js провалидировать данные которые вводит пользователь. При вводе букв — писать ему ошибку при помощи js. В поле поиска вводим id клиента или название клиента, выбираем договора которые показывать, при нажатии на кнопку «отправить» отправляется запрос ajax. Возвращается ответ в json, в jquery разбирается ответ и выводится в карточку. Если нет такого клиента — сообщение, что нет клиента.

Карточка для вывода информации
<html>
	<head>
		<title>тестовое задание</title>
	</head>
	<body>
		<table>
			<tr>
 				 <td colspan=2><b>информация про клиента</b></td>
 			 </tr>
 			 <tr>
 				 <td >название клиента</td>
				<td >[name_customer]</td>
 			 </tr>
 			 <tr>
 				 <td >компания</td>
 				<td >[ company]</td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про договор</b></td>
 			 </tr>
			<tr>
 				 <td >номер договора</td>
 				<td >[ number]</td>
 			 </tr>
 			 <tr>
 				 <td >дата подписания</td>
 				<td >[ date_sign]</td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про сервисы</b></td>
 			 </tr>
 			 <tr>
 				 [services_name]
				<!-- в services_name вывести название сервисов через <br> --> 
			</tr>
		</table>
	</body>
</html>