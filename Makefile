# 生成翻译pot模板.用于作为模板各种语言翻译
pot:
	xgettext --from-code=UTF-8 -o locale/messages.pot *.php

#上传到服务器
upload:
	rsync -v -P -e ssh '/home/zodiac1111/tmp/wtb-db/' root@vps2:/var/www/ -r --exclude=".*"

# 从pot翻译模板文件中 更新翻译文件(po) 
update-po:
	find -iname messages.po -exec msgmerge '{}' locale/messages.pot -o '{}' \;
