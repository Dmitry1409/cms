import os, shutil


nSite = "var"
publFol = "public_html"
basa ="cms.db"
copFol = ['upload_img', 'Roboto', 'img']

pathArr = ['config_cms.php', 'js/main.js', 'mailer/send_mail.php',
			'scripts_php/add_feedback.php', 'templates/mainHead.php', 'templates/startMainHead.php', ".htaccess",'index.php']
nRowArr = [[2, 3], [21], [93,96,97,98,99,100], [110, 123], [21,35], [99, 113], [0,1,2,3,4,5,6,7,8,9,10,11,12], [58]]

checkArr = [['	$domain = "http://localhost";', '	$root_dir = "/cms/";'],
			['const root_dir = "/cms/"'],
			['echo "success";', '// if($mail->send()){', '// 	echo "success";', '// }else{', '// 	echo $mail->ErrorInfo;', '// }'],
			['		// autoRotateImage($avatarDirOrig.$n_name);', '			// autoRotateImage($revDirOrig.$n_name);'],
			['	<!-- <script type="text/javascript" >', '	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->'],
			['	<!-- <script type="text/javascript" >', '	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->'],
			['#php_flag display_startup_errors off', '#php_flag display_errors off', "#php_flag html_errors off", "#php_flag log_errors on",
			'#php_flag ignore_repeated_errors off', '#php_flag ignore_repeated_source off', "#php_flag report_memleaks on", '#php_flag track_errors on',
			'#php_value docref_root 0', '#php_value docref_ext 0', '#php_value error_log /home/n/n92029rw/cms/public_html/PHP_errors.log',
			'#php_value error_reporting 2047','#php_value log_errors_max_len 0'],
			["	if($f == 'cms'){"]]
nArr = [['	$domain = "https://auroom-nn.ru";', '	$root_dir = "/";'],
		['const root_dir = "/"'],
		['// echo "success";', 'if($mail->send()){', '	echo "success";', '}else{', '	echo $mail->ErrorInfo;', '}'],
		['		autoRotateImage($avatarDirOrig.$n_name);', '			autoRotateImage($revDirOrig.$n_name);'],
		['	<script type="text/javascript" >', '	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript>'],
		['	<script type="text/javascript" >', '	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript>' ],
		['php_flag display_startup_errors off', 'php_flag display_errors off', 'php_flag html_errors off', "php_flag log_errors on",
		'php_flag ignore_repeated_errors off', 'php_flag ignore_repeated_source off', 'php_flag report_memleaks on', 'php_flag track_errors on',
		'php_value docref_root 0', 'php_value docref_ext 0', 'php_value error_log /home/n/n92029rw/cms/public_html/PHP_errors.log',
		'php_value error_reporting 2047','php_value log_errors_max_len 0'],
		["	if($f == ''){"]]


def changFile(path, nRow, checkStr, newRow):
	f = open(path, "r", encoding="utf-8")
	print("Открыт файл "+path)
	lRow = f.readlines()
	fl = False
	for i in range(len(nRow)):
		r = lRow[nRow[i]][:-1]
		if r == checkStr[i]:
			lRow[nRow[i]] = newRow[i] + chr(10)
			print(f"строка № {nRow[i]} заменена на {newRow[i].strip()}")
			fl = True
		else:
			print(f"Ошибка в строке № {nRow[i]} нет совпадения")

	f.close()
	if fl:
		nFile = open(path, "w", encoding="utf-8")
		nFile.writelines(lRow)
		nFile.close()
		print(f"Файл {path} перезаписан")


def main():
	os.mkdir(nSite)
	print(f"Создана временая папка {nSite}")
	os.chdir(nSite)
	os.system('git clone https://github.com/Dmitry1409/cms.git .')
	print('Репозиторий гит склонирован')

	for i in range(len(pathArr)):
		changFile(pathArr[i], nRowArr[i],checkArr[i], nArr[i])

	os.chdir("..")

	shutil.copyfile(publFol+'/'+basa, nSite+'/'+basa)
	print(f"Файл {basa} скопирован в {nSite}")

	for fol in copFol:
		shutil.copytree(fol, nSite+'/'+fol)
		print(f"Папка {fol} скопирована в папку {nSite}")

	shutil.rmtree(publFol)
	print(f"Папка {publFol} удалена")

	os.rename(nSite, pubFol)
	print(f"Папка {nSite} переименована в {publFol}")
	print("Complite")
	
main()
