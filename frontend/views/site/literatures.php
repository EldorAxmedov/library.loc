<section class="blog-area ptb-140 bg-1">
            <div class="container">
                <div class="row">
                    <?php foreach ($books as $book):?>
                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                        <div class="blog-wrap mb-30">
                            <div class="blog-img">
                            <img src="<?php echo $book['img'] ? '/uploads/books/crop/' . $book['img'] : '/images/is_book.jpg'; ?>" alt="">
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <ul>
                                        <li><a href="#">Nashriyot: <?=$book['id'] ? $book['id'] : ''?></a></li>
                                        <li><a href="#">Nashriyot: <?=$book['publisher'] ? $book['publisher'] : ''?></a></li>
                                        <li><a href="#">UDK: <?=$book['udk'] ? $book['udk'] : ''?></a></li>                                        
                                    </ul>
                                </div>
                                
                                <?php $book_authors = explode(",", $book['authors'])?> 
                                <?php foreach ($book_authors as $book_author):?>                                
                                <h6><?=$book_author?></h6>
                                <?php endforeach;?>
                                <p><?=$book['name']?></p>
                                <a href="blog.html" class="btn-style">Batafsil</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="col-xs-12">
                        <div class="pagination-wrap">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href=""><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>