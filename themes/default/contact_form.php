<?php
if($var['submitted'] != true) {
	?>
   <form action="" method="post">
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th colspan="2">E-Mail Bill Goold directly</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th>Full Name</th>
               <td><input type="text" name="full_name" class="input-xlarge" /></td>
            </tr>
            <tr>
               <th>E-Mail</th>
               <td><input type="text" name="email" class="input-xlarge" /></td>
            </tr>
            <tr>
               <th>Comment</th>
               <td><textarea rows="3" name="comment" id="textarea" class="input-xlarge"></textarea></td>
            </tr>
            <tr>
               <td colspan="2">
                  <label class="checkbox" for="newsletter">
                     <input type="checkbox" value="1" name="newsletter" id="newsletter" />
                     I would like to receive the Evolve Pro Tour newsletter.
                  </label>
               </td>
            </tr>
         </tbody>
      </table>
      
      <button type="submit" class="btn btn-danger alignright">Send Comment</button>
   </form>
   <?php
} else {
	?>
	
   <div class="alert alert-success">
   	<h3>Thank you for your comment.</h3>
   </div>
	
   <?php
}