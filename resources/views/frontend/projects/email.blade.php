<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mail</title>
</head>
<body>
<h3>Thông tin khách liên hệ dự án : <span style="color:red">{{ $projectsDetail->name }}</span></h3>
<table align="center" border="1" cellpadding="15" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#444;line-height:18px">
  <tbody>
    <tr>
      <td width="100px">Họ tên</td>
      <td>{{ $dataArr['full_name'] }}</td>
    </tr>
    <tr>
      <td>Điện thoại</td>
      <td>{{ $dataArr['phone'] }}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{ $dataArr['email'] }}</td>
    </tr>
    <tr>
      <td>Nội dung</td>
      <td>{{ $dataArr['content'] }}</td>
    </tr>
  </tbody>
</table>

</body>
</html>