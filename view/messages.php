<!-- SELECTOR -->
<h3 class="text-xl font-hairline">Reviews</h3>
<form action="" method="post">
  <select name="reviews" id="reviews" class="hover:bg-purple-500 hover:border-black px-2 text-center text-white bg-gray-700 border rounded appearance-none" onchange="this.form.submit()">
    <option value="10">?</option>
    <option value="2">2</option>
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
  </select>
</form>

<!-- MESSAGES -->
<div class="max-w-xl mx-auto"><?= $showPosts->printPosts($seeAmount) ?></div>