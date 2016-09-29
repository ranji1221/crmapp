<?php
	echo '自定义的错误处理页面.';
	echo '异常状态码：' . $exception->statusCode . '<br/>';
	echo '异常信息：' . $exception->getMessage();