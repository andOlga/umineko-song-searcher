<style>
body {
  color: gray;
  background-color: #3d1600;
  max-width: 640px;
  margin-left: auto;
  margin-right: auto;
}
input[type=text] {
  width: 640px;
  display: block;
}
input[type=submit] {
  margin-left: 250px;
}
</style>
<form action='/test.php' method='post'>
    <input type='text' name='findstr'>
    <input type='submit'>
    </form>
    Type some text from Umineko no Naku Koro ni to figure out the song that plays at this moment. Notes:
    <ul>
      <li>This works only with the official translation that is published by Mangagamer, with or without the 07th Mod patch.
        This won't work if you're reading the old Witch Hunt translation patch, UmiTweak, or Umineko Project
        due to translation differences.</li>
      <li>Pieces of text that are too long may not work (due to formatting commands appearing in the middle).</li>
      <li>Pieces of text that are too short may end up with the wrong song result because they are not unique.</li>
      <li>If the song that is found doesn't seem correct, try searching for a longer piece of text or just scroll forward/backward a bit and try a different one.</li>
      <li>
          Generally, a piece of text corresponding to a single voice clip should work, but it doesn't have to even be a complete sentence.
      </li>
      <li>
          Sequences of about 5 words, give or take, tend to work correctly.
      </li>
</ul>
