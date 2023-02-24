<?php 
  require 'sendMessage.php';

// ตัวอย่างข้อมูล
$products = array(
    array(
        'name' => 'Product 1',
        'price' => '$10.00',
        'image_url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png',
        'description' => 'This is product 1',
    ),
    array(
        'name' => 'Product 2',
        'price' => '$20.00',
        'image_url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png',
        'description' => 'This is product 2',
    ),
    array(
        'name' => 'Product 3',
        'price' => '$30.00',
        'image_url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png',
        'description' => 'This is product 3',
    ),
);

// loop ข้อมูลและสร้าง bubble สำหรับแต่ละข้อมูล
$bubbles = array();
foreach ($products as $product) {
    $bubble = array(
        'type' => 'bubble',
        'hero' => array(
            'type' => 'image',
            'url' => $product['image_url'],
            'size' => 'full',
            'aspectRatio' => '20:13',
            'aspectMode' => 'cover',
        ),
        'body' => array(
            'type' => 'box',
            'layout' => 'vertical',
            'spacing' => 'sm',
            'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $product['name'],
                    'size' => 'xl',
                    'weight' => 'bold',
                    'wrap' => true,
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                        array(
                            'type' => 'text',
                            'text' => $product['price'],
                            'flex' => 0,
                            'size' => 'xl',
                            'weight' => 'bold',
                            'wrap' => true,
                        ),
                    ),
                ),
                array(
                    'type' => 'text',
                    'text' => $product['description'],
                    'size' => 'sm',
                    'wrap' => true,
                ),
            ),
        ),
    );
    // เพิ่ม bubble ลงใน array ของ bubbles
    $bubbles[] = $bubble;
}

//สร้างหัว flex message
$flexMessage = array(
    'type' => 'flex',
    'altText' => 'Flex Message	',
    'contents' => array(
        'type' => 'carousel',
        'contents' => $bubbles,
    ),
);

// เปลี่ยน flex message ให้เป็น JSON format
$flexDataJson = json_encode($flexMessage,true);

// token ของ messaging API และ to เป็น User ID ของผู้ที่จะส่งให้
  $datas['url'] = "https://api.line.me/v2/bot/message/push";
  $datas['token'] = "X60pZY7wrDmox5r3KAmID7Cfc6pIXAjIiFYq6WbAS/8jHngD92fzTUqE4LqUot46NhC72PFCLQv8rcWYz4fO4eBICY/XgHriUsi9kT9e9gvr9ezXr6trVwPGNvLeOJprq/QDQK4FQjHdqOk5c8MS4QdB04t89/1O/w1cDnyilFU=";
  $messages['to'] = "Ubc3a95ba6527385cc8c2212c42ad5090";
  $messages['messages'][] = json_decode($flexDataJson, true);

  $encodeJson = json_encode($messages);
  sentMessage($encodeJson,$datas);
?>