<?php get_header(); ?>

<div class="main-category">
        
    <?php
    if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
    }
    ?>

    <?php

    /* Spara alla poster för den aktuella kategorien */
    $args = array( 
        'category' => 8,
        'numberposts' => 0,
        'hide_empty' => FALSE,
    );
    
    /* Spara posterna i denna lista*/
    $postslist = get_posts( $args );   
 
    /* Ha koll på hur många poster som visas och synka */
    $last_post_in_this_array = sizeof( $postslist ) - 1;

    /* Denna kommer hjälpa till att hålla koll på när radbrytning behövs. */
    /*  Efter tre kategorier/artiklar ska ny rad infogas */   
    $post_counter = 1;

    /* Ha koll på varje omgångs index i foreach-loopen */
    $i = -1;

    foreach( $postslist as $post ) { 

        setup_postdata( $post );
        $i++;

        /* Följande if-sats avgör, utifrån hur många poster som finns, när ny kolumn ska skapas */
        /* Denna första skapar en hel kolumn, med både start- och sluttagg, om det bara finns en enda post */
        if( $last_post_in_this_array == 0 ) {
        ?>
        
            <!-- Divar som tar hand om presentationen för kategorier och produkter -->
            <div class="category-or-product-row">
                <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>      
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
    
                    <div class="category-or-product-description">
                        <?php echo excerpt(8); ?>
                    </div>
                </div>
            </div>
            
        <?php
        }
        
        /* Hanterar första posten för alla rader, när denna är sista posten. */
        /* Detta görs för samtliga rader UTOM första raden */
        /* Så kolumn 1 för rad 2, kolumn 1 för rad 3, etc, när posten som visas är den sista */
        elseif( ( $post_counter == 1 ) && ( $i === $last_post_in_this_array ) ) {
        ?>
        
            <!-- Divar som tar hand om presentationen för kategorier och produkter -->
            <div class="category-or-product-row">
                <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>        
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
    
                    <div class="category-or-product-description">
                        <?php echo excerpt( 8 ); ?>
                    </div>
                </div>
            </div>
            
        <?php
        }
        
        /* Detta är alltid post nummer 1, när det kommer minst en post till. Så här behövs aldrig en sluttag */
        elseif( ( $post_counter == 1 ) && ( $i !== $last_post_in_this_array ) ) {
        ?>
        
            <!-- Divar som tar hand om presentationen för kategorier och produkter -->
            <div class="category-or-product-row">
            <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>        
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
    
                    <div class="category-or-product-description">
                        <?php echo excerpt( 8 ); ?>
                    </div>
                </div>
            <!-- Sluttaggen borttagen här -->
            
        <?php

            /* Nu måste vi hålla koll på antalet poster med följande räknare */
            $post_counter++;
        }    
        
        /* Denna behandlar scenariot när kolumn 2 är sista posten som visas, för någon rad */
        /* Så ingen starttag då den alltid kommit tidigare. Däremot ska sluttag alltid visas här */
        elseif( ( $post_counter === 2 ) && ( $i == $last_post_in_this_array ) ) {
        ?>
        
                <!-- Starttaggen för row borttagen -->
                <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>        
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
    
                    <div class="category-or-product-description">
                        <?php echo excerpt( 8 ); ?>
                    </div>
                </div>
            </div>
            
        <?php
            /* Nollställer räknaren */
            $post_counter = 1;
        }    

        /* Detta är post nummer två, där den aldrig är sist. Så varken start- eller sluttag här */
        elseif( ( $post_counter == 2 ) && ( $i != $last_post_in_this_array ) ) {
        ?>
        
            <!-- Starttaggen för row borttagen -->
                <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>       
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
    
                    <div class="category-or-product-description">
                        <?php echo excerpt( 8 ); ?>
                    </div>
                </div>
            <!-- Sluttaggen för row borttagen -->
            
        <?php
        $post_counter++;
        }

        /* Post nr. tre för varje rad är alltid den sista, så här ska alltid sluttagg användas, och aldrig starttag. */
        elseif ( $post_counter == 3 ) {
            ?>
        
            <!-- Starttaggen för row borttagen -->
                <div class="category-or-product">
                    
                    <div class="category-or-product-image-holder">
                        <?php echo the_post_thumbnail() ?>        
                    </div>

                    <a href="<?php echo the_permalink(); ?>">
                        <div class="category-or-product-title"><h4><?php the_title(); ?></h4></div> 
                    </a>
                    
                    <div class="category-or-product-description">
                        <?php echo excerpt( 8 ); ?>
                   </div>
                </div>
            </div>
            
        <?php
        $post_counter = 1;
        }
    } 
 
    ?>
</div>    
    
<?php get_sidebar(); ?>

<br>

<?php get_footer();