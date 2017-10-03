<?php

return [    
    'paging' => 100, // number rows for paging
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/media/uploads'
    ],    

    'num_alert' => 10, // number rows for alert on top menu
    'upload_path' => public_path() . '/uploads/images/', // media_upload_path   
	'upload_thumbs_path' => public_path() . '/uploads/images/thumbs/', // media_upload_path
    'upload_thumbs_path_2' => public_path() . '/uploads/images/thumbs/175x117/', // media_upload_path
    'upload_thumbs_path_3' => public_path() . '/uploads/images/thumbs/231x154/', // media_upload_path
    'upload_thumbs_path_articles' => public_path() . '/uploads/images/thumbs/articles/', // media_upload_path  
    'upload_thumbs_path_cate' => public_path() . '/uploads/images/thumbs/cate/', // media_upload_path  
    'upload_url' => config('app.url') . '/public/uploads/images/', // image path,
    'upload_url_thumbs' => config('app.url') . '/public/uploads/images/thumbs/', // image path,
    'upload_url_thumbs_2' => config('app.url') . '/public/uploads/images/thumbs/175x117/', // image path, 
    'upload_url_thumbs_3' => config('app.url') . '/public/uploads/images/thumbs/231x154/', // image path,    
    'max_size_upload' => 8000000
];

?>
