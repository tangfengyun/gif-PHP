####    功能说明
这是一个关于PHP生成动态倒计时的图片,适用于任何时区。通过设置背景，结束时间，背景颜色(主题),时区，帧来控制的倒计时图片。如:http://gif.pro.com/20200420-1-2-100.gif
映射到http://gif.pro.com/gif.php?time=2020-04-09&theme=1&timezone=2&delay=100。

####    安装说明：
运行前，先配置好nginx的配置文件
-   1.nginx的配置文件的配置内容在nginx.conf内，可以直接复制，也可根据自己的电脑配置。
-   2.访问的主文件是gif.php
-   3.主题文件包是theme,可以在该文件夹下添加自己喜欢的主题，然后在Theme.class.php中加入该文件的路径
-   4.时区设置在TimeZone.class.php中，可以根据需要添加自己需要的时区配置
-   5.默认的一些配置在Config.class.php中