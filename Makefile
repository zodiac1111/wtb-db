# 翻譯
po:gen_pot update-po
# 生成翻译pot模板.用于作为模板各种语言翻译
gen_pot:
	xgettext --from-code=UTF-8 -o locale/messages.pot *.php

# 从pot翻译模板文件中 更新翻译文件(po) 
update-po:
	find -iname messages.po -exec msgmerge '{}' locale/messages.pot -o '{}' \;

#上传到服务器
upload:
	rsync -v -P -e ssh '/home/zodiac1111/tmp/wtb-db/' root@vps2:/var/www/ -r --exclude=".*"


