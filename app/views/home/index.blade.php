<html>
   <head>
     <title><?=$title ?></title>
   </head>
   <body>
        <h1>this is home <?=$title ?></h1>
         <?php foreach ($products as $product):?>
             
         <div>
            <h3><?=  $product['name']; ?></h3>
            <h3><?=  $product['price    ']; ?></h3>
         </div>
        <?php endforeach ;?>
   </body>

</html>