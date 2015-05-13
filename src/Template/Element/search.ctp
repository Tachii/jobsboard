<div id="search_area" class="col_12 column">
	<form class="horizontal" method="post" action="<?php echo $this->request->webroot; ?>jobs/browse">
		<input name="keywords" id="keywords" type="text"placeholder="Enter Keywords..." />
		<select name="city" id="city_select" name="city">
			<option selected>Select City</option>
			<option>Chisinev</option>
			<option>Beltsy</option>
		</select>
		<select name="category" id="category_select" name="category">
			<option selected>Select Category</option>
			<?php foreach($categories as $category) : ?>
				<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit">Submit</button>
	</form>
</div>
<br />