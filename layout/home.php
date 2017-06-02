<!-- Banner -->
        <section class="home-top-section">
            <div class="banner-section">
                <section class="ui segment banner slider square" id="banner">
                    <?php 
                        $pdo = Database::connect();
                        $sql = 'SELECT banner_url FROM banner ORDER BY id_banner ASC';
                        foreach ($pdo->query($sql) as $row){
                            echo '<div>';
                            echo '<img class="center-cropped" src="'.$row['banner_url'].'">';
                            echo '</div>';
                        }
                        Database::disconnect();
                    ?>
                </section>
            </div>
        </section>

        <!-- Kelebihan Custom -->
        <section class="custom-section">
            <div class="ui container">
                <div class="ui segment square" id="custom">
                    <div class="ui text container">
                        <div class="ui center aligned header">
                            Kelebihan Custom
                        </div>
                    </div>
                    <div class="ui divider"></div>
                    <div class="ui stackable equal width padded grid" style="padding-left: 2em; padding-right: 2em;">
                    <?php
                        $custom_adv = [["Desain", "Desain yang beragam.", "diamond"], ["Warna", "Warna sesuai keinginan.", "theme"], ["Ukuran", "Ukuran sesuai kebutuhan.", "sort"]];
                        for ($i = 0; $i < sizeof($custom_adv); $i++){
                    ?>
                        <div class="column">
                            <h4 class="ui header">
                            <?php
                            echo '<i class="blue '.$custom_adv[$i][2].' icon"></i>'.
                                    '<div class="content">'.$custom_adv[$i][0].
                                    '<div class="sub header">'.$custom_adv[$i][1].'</div>'.
                                    '</div>';
                            ?>
                            </h4>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Icon Kategori -->
        <section class="ico-category-section">
            <div class="ui very padded container">
                <div class="ui stackable equal width grid">
                    <?php 
                        $pdo = Database::connect();
                        $sql = 'SELECT category_name FROM product_category ORDER BY id_category ASC';
                        $list_ico_kategory = ['ico_kaos.svg', 'ico_kemeja.svg', 'ico_polo.svg', 'ico_hoodie.svg', 'ico_sweater.svg', 'ico_tas.svg', 'ico_celana.svg'];
                        $i = 0;
                        foreach ($pdo->query($sql) as $row){
                    ?>

                    <div class="column">
                        <div class="ui very padded segment square">
                        <?php 
                            echo '<a class="ui tiny image" href="?p='.strtolower($row['category_name']).'">';
                            echo '<img src="public/images/'.$list_ico_kategory[$i].'">';
                            echo '</a>';
                            $i++;
                        ?>
                        </div>
                    </div>

                    <?php 
                        }
                    ?>

                </div>
            </div>
        </section>

        <!-- Show Barang per Kategori -->
        <section class="showroom-section">
            <div class="ui container">

                <?php 
                    foreach ($pdo->query($sql) as $row){
                ?>
                    <div class="barang-section">
                        <div class="ui blue very padded segment" id="show-barang">
                            <div class="ui stackable grid">
                                <div class="eight wide column">
                                    <div class="ui left aligned header">
                                        <?= $row['category_name']; ?>
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <a href="?p=content-category" class="ui right floated inverted blue button">Lihat Selengkapnya</a>
                                </div>
                            </div>

                            <div class="ui divider"></div>

                            <div class="ui container">
                                <div class="ui five stackable cards">

                                    <?php for($x = 0; $x < 5; $x++) {
                                        echo '<div class="card">';
                                        echo '<a class="image" href="?p=content-detail">
                                            <img src="public/images/gravicloth-logo.png">
                                        </a>';
                                        echo '<div class="content">
                                                <a class="header" href="#">'.
                                                    $row['category_name'].' '.($x + 1).
                                                '</a>
                                                <div class="meta">
                                                    <a>'.'Rp '.((10000 * $x) + 10000).'</a>
                                                </div>
                                            </div>';
                                        echo '</div>';
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    } 
                    Database::disconnect();
                ?>            

            </div>
        </section>