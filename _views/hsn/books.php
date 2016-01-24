<div class="info-bar">
    <div class="info-bar-header">
        <div class="row">
            <a id="close-sidebar" class="pull-right" role="button"><i class="fa fa-times"></i></a>
        </div>
        <h3 class="main-title"></h3>
        <h3 class="subtitle"></h3>
    </div>
    <div class="book-authors"></div>
    <div class="book-summary-wrapper scrollbar-inner">
        <div class="book-summary"></div>
    </div>
    <div class="book-price"></div>
</div>

<div class="content">
    <div class="header">
        <div class="col col-1 extra">
            <h1>
                <?php
                    foreach ($array['categories'] as $category) {
                        if ($category['IDCategory'] == param(1)) {
                            echo $category['Name'];
                            break;
                        }
                    }
                ?>
            </h1>
        </div>

        <div class="col col-3">
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Traži..." />
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="btn-clear"><i class="fa fa-times"></i></button>
                </span>
            </div>
        </div>
    </div>

    <div class="library scrollbar-inner" id="library">
        <?php foreach($array['books'] as $book): ?>
        <div class="book" id="book-<?php echo $book['IDBook']; ?>" data-description="<?php echo $book['Description']; ?>" data-subtitle="<?php echo $book['Subtitle']; ?>">
            <div class="cover">
                <img src="/images/<?php if ($book['Cover']): ?>covers/<?php echo $book['Cover']; else: ?>no-cover<?php endif; ?>.jpg" alt="Knjiga" />
                <?php if ($book['DiscountPrice']): ?>
                <div class="old-price"><?php echo $book['Price']; ?></div>
                <div class="price"><?php echo $book['DiscountPrice']; ?></div>
                <?php else: ?>
                <div class="price"><?php echo $book['Price']; ?></div>
                <?php endif; ?>
            </div>
            <h3 class="title"><?php echo $book['Title']; ?></h3>
            <?php if($book['ShowSubtitle']): ?>
            <h3 class="bookSubtitle"><?php echo $book['Subtitle']; ?></h3>
            <?php endif; ?>

            <?php if($book['Authors']): foreach($book['Authors'] as $author): ?>
            <h4 class="author"><?php echo $author['Name']; ?></h4>
            <?php endforeach; endif; ?>
        </div>
        <?php endforeach; ?>
<!--
        <textarea><?php var_dump($array['books']); ?></textarea>
-->
    <!--
    <div class="book">
        <div class="cover">
            <img src="images/covers/no-cover.jpg" alt="Knjiga" />
            <div class="price">100,00</div>
        </div>
        <h3 class="title">Naslov</h3>
        <h4 class="author">Autor</h4>
    </div>
    -->
    </div>
</div>