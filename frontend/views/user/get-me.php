
<?php $this->title = 'Foydalanuvchi profili';?>
<div class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Kitob haqida ma'lumotlar</h4>        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="book-info">
       <table class="table table-hover"> 
    <tr><td><strong>Kitob nomi</strong></td>  <td class="book-title"></td></tr>
    <tr><td><strong>Kitob muallifi</strong></td>  <td class="book-author"></td></tr>
    <tr><td><strong>Kitob yili</strong></td>  <td class="book-year"></td></tr>
    <tr><td><strong>Kitob kategoriyasi</strong></td>  <td class="book-genre"></td></tr>
    <tr><td><strong>Kitob sahifalari</strong></td>  <td class="book-pages"></td></tr>
</table>
          <hr>     
        </div>
        <div class="text-center">
       <img src="" alt="" class="book-image">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>    
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb mt-30 mb-30">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Foydalanuvchi profili</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?=$user->picture?$user->picture:'\images\no_image.png'?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=$user->full_name?></h4>
                      <p class="text-secondary mb-1"><?php $user->type=='student' ? 'Talaba' : 'Xodim'?></p>               
                    
                    </div>
                  </div>
                </div>
              </div>         
            </div>
            <div class="col-md-9">
            <table class="table table-hover" width="100%">
  <thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col">Kitob nomi</th>
      <th scope="col">Nashr yili</th>
      <th scope="col">Kitob olingan sana</th>
      <th scope="col">Qaytarilishi zarur bo'lgan sana</th>
      <th scope="col">Holati</th>
      <th scope="col">Kitobni ko'rish</th>
    </tr>
  </thead>
  <tbody>
    <?php $counter = 1;?>
    <?php if($books == null): ?>
    <tr>
      <td colspan="7" class="text-center">Sizda kutubxonadan olingan kitoblar mavjud emas</td>
    </tr>
    <?php endif;?>
    <?php foreach($books as $item):?>
    <tr <?=$item->submission==1 ? 'class="table-success"' : 'class="table-danger"'?>>
      <th scope="row"><?=$counter?></th>
      <input type="hidden" name="book_id" value="<?=$item->book_id?>">
      <td><?=$item->book->name?></td>
      <td><?=$item->book->year_id?></td>
      <td><?=date('d-m-Y', $item->get_date)?></td>
      <td><?=date('d-m-Y',$item->final_date)?></td>     
      <td><?=$item->submission==1 ? 'Kutubxonaga topshirilgan' : 'Kutubxonaga topshirilmagan'?></td>
      <td><input type="button" class="btn btn-success" value="Kitobni ko'rish" id="getbook"></td>
 
    </tr>
    <?php
    $counter++;
    ?>
    <?php endforeach;?>
  </tbody>
</table>
            </div>
          </div>
          
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
    $('#getbook').click(function(){
      var book_id = $(this).parent().parent().find('input[name="book_id"]').val();
      console.log(book_id);   
      $.ajax({
        url: '/user/get-book',
        type: 'GET',
        data: {id: book_id},
        success: function(res){          
          $('.book-title').text(res.name);         
          let authors = res.authors.map(function(author) {
            return author.full_name;            
        }).join(', ');
          $('.book-author').text(authors);
          $('.book-year').text(res.publish_year);
          $('.book-genre').text(res.category);
          $('.book-pages').text(res.pages);
          if(res.picture == null){
            $('.book-image').attr('src', '/images/no_image.png');
          }else{
          $('.book-image').attr('src', res.picture);
          }
        }
      });
       $('.modal').modal('show')
    });
  });
</script>