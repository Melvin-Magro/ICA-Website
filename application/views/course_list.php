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
<?php if ($can_delete): ?>
	<th colspan="2">Actions</th>
<?php endif; ?>
  </tr>
  <tr>
	  <?php foreach($courses->result_array() as $course): ?>
  	<tr>
  		<td><?=$course['course_name'];?></td>
  		<td><?=$course['course_level'];?></td>
<?php if ($can_delete): ?>
		<td><?=anchor("courses/delete/{$course['id']}", "Delete");?></td>
		<td><?=anchor("edit/{$course['id']}", "Edit");?></td>
<?php endif; ?>
  	</tr>
  <?php endforeach; ?>
  </tr>
</table>

	</body>
</html>
