<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>注册</h1>
  <form id="signup">
    <input type="text" name="username" placeholder="用户名">
    <input type="password" name="password" placeholder="密码">
    <button type="submit">提交</button>
  </form>
  <?php import('view/component/js') ?>
  <script src="/js/public/signup.js"></script>
</body>
</html>