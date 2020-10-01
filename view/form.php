<form action="" method="POST" class="">

  <!-- TITLE -->
  <div class="m-4">
    <label for="title" class="block pr-4 mb-1 font-medium text-gray-700">Title</label>
    <input required type="text" name="title" id="title" placeholder="Add title..." class="focus:outline-none focus:bg-white focus:border-purple-500 w-full max-w-lg px-4 py-2 leading-tight text-gray-700 bg-gray-200 border-2 border-gray-200 rounded appearance-none">
  </div>

  <!-- CONTENT -->
  <div class="m-4">
    <label for="content" class="block pr-4 mb-1 font-medium text-gray-700">Content</label>
    <textarea required rows="5" name="content" id="content" placeholder="Add content..." class="focus:outline-none focus:bg-white focus:border-purple-500 w-full max-w-lg px-4 py-2 leading-tight text-gray-700 bg-gray-200 border-2 border-gray-200 rounded appearance-none"></textarea>
  </div>

  <!-- AUTHOR -->
  <div class="m-4">
    <label for="author" class="block pr-4 mb-1 font-medium text-gray-700">Author</label>
    <input required type="text" name="author" id="author" placeholder="Add author..." class="focus:outline-none focus:bg-white focus:border-purple-500 w-full max-w-xs px-4 py-2 leading-tight text-gray-700 bg-gray-200 border-2 border-gray-200 rounded appearance-none">
  </div>

  <!-- DATE -->
  <div class="m-4">
    <label for="date" class="block pr-4 mb-1 font-medium text-gray-700">Date</label>
    <input required type="text" name="date" id="date" value="<?= date("d/m/Y") ?>" class="focus:outline-none focus:bg-white focus:border-purple-500 w-full max-w-xs px-4 py-2 leading-tight text-gray-700 bg-gray-200 border-2 border-gray-200 rounded appearance-none">
  </div>

  <!-- BUTTON -->
  <div class="m-2">
    <button type="submit" name="submit" value="submit" class="hover:bg-purple-400 hover:border-black focus:shadow-outline focus:outline-none px-4 py-2 my-4 font-bold text-white bg-purple-500 border rounded shadow">Submit</button>
  </div>

</form>