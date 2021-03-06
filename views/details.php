<div class="items-flex">

<?php 
if( isset($_GET['id']) || (isset($_GET['store']) && isset($_GET['id']))) : 
     foreach( $toys as $toy ): ?>
     <!-- Display each toy -->
        <div class=img>
            <img src="/img/<?php echo $toy['image'] ?>" alt= "<?php echo $toy['name'] ?>">

        <p><?php echo str_replace('.' , ',', $toy['price'])?>€</p>
        <!-- Form to choose a store -->
        <form class="store-form" action="" method="get">
            <input type="hidden" name="id" value= <?php echo $_GET['id'] ?>>
            
            <select name="store">
            <?php if( !isset($_GET['store']) || $_GET['store'] === 'choose-a-store' ): ?>
                <option value="choose-a-store">Quel magasin ?</option> 
            <?php endif ?>
                <?php foreach( $stores as $store ): ?>
                    <?php $_GET['store'] === $store['store_id'] ? $selected = 'selected' :  $selected = '';?>

                <option value="<?php echo $store['store_id'] ?>"<?php echo $selected ?>><?php echo $store['store_name'] ?></option>
                <?php endforeach ?>
            </select>
            
            <button type="submit">Ok</button>

        </form>
        <!-- Display stock -->
        <h6>Stock : 
            <span>
                <?php 
                foreach( $stocks as $stock):
                    if( isset($_GET['id']) && isset($_GET['store'])) :
                        echo $stock['quantity'];
                    else:     
                        echo $stock['stock_total'];
                    endif; 
                endforeach;?>
            </span>
        </h6>
    </div>

    <!-- Display Brand -->
    <div class="content">
        <h6>Marque : 
            <span><?php echo $toy['brand_name'] ?></span>
        </h6>
        <span><?php echo $toy['description'] ?></span>
    </div>
    <?php endforeach ;
endif ?>

</div>