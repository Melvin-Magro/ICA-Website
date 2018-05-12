<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">

		<title>Courses</title>
	</head>
	<body>

<table id="customers">
  <tr>
	<th>Course Name</th>
  	<th>Course Level</th>
  </tr>
  <tr>
	  <?php foreach($courses->result_array() as $course): ?>
  	<tr>
  		<td><?=$course['course_name'];?></td>
  		<td><?=$course['course_level'];?></td>
  	</tr>
  <?php endforeach; ?>
  </tr>
</table>

	</body>
</html>
