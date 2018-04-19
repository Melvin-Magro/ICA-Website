<table id="foundation_table">
  <thead>
    <tr>
      <th scope="col">Course Name</th>
      <th scope="col">Course Level</th>
    </tr>
  </thead>
  <tbody>
	  <?php foreach($courses->result_array() as $course): ?>
    <tr>
	  <td><?=$course['course_name'];?></td>
	  <td><?=$course['course_level'];?></td>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>
