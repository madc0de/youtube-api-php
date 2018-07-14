# YouTube API v3 PHP Wrapper & YouTube Downloader

A basic PHP wrapper for the Youtube Data API v3 ( Non-OAuth ). Designed to let devs easily fetch public data (Video & Channel) from Youtube. No 3rd party dependancy. The reason of returning the ARRAY response directly is to keep it simple.

Some parameters are missing in this library, because I don't need them at this point, if you desire a particular feature please file an issue here :smile:

## Requirements

* PHP >=5.3
* CURL extension in PHP

## Install

Run the following command in your command line shell in your php project

```
composer require madcodez/youtube
```

## Usage

### Example usage of getting "Top of the chart" videos :

```php
<?php

require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$chart = $youtube->chart('10', $pageToken);

print_r($chart);
```

### Example usage of getting Category wise "Top of the chart" videos : 

```php
<?php

require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$catVid = $youtube->videoByCat('2', '10', $pageToken);

print_r($catVid);
```

### Example usage of Searching :

```php
<?php
require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$seach = $youtube->search('Web Development', '10', $pageToken);

print_r($search);
```

### Example usage of video info :

```php
<?php

require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$video = $youtube->video('rie-hPVJ7Sw');

print_r($video);
```

### Example usage of getting channel wise video :

```php
<?php

require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$channel = $youtube->channel('UC0gTtCL29NCuex5OApWXpPQ', '10', $pageToken);

print_r($channel);
```

### Example usage of getting related videos :

```php
<?php

require 'vendor/autoload.php';

$youtube = new Madcodez\YouTube\YouTube('* Your API key here *');

$related = $youtube->related('nLzV5l0Enww', '10', $pageToken);

print_r($related);
```

## YouTube API Video Category ID : 

2 - Autos & Vehicles

1 -  Film & Animation

10 - Music

15 - Pets & Animals

17 - Sports

18 - Short Movies

19 - Travel & Events

20 - Gaming

21 - Videoblogging

22 - People & Blogs

23 - Comedy

24 - Entertainment

25 - News & Politics

26 - Howto & Style

27 - Education

28 - Science & Technology

29 - Nonprofits & Activism

30 - Movies

31 - Anime/Animation

32 - Action/Adventure

33 - Classics

34 - Comedy

35 - Documentary

36 - Drama

37 - Family

38 - Foreign

39 - Horror

40 - Sci-Fi/Fantasy

41 - Thriller

42 - Shorts

43 - Shows

44 - Trailers

## Format of returned data

The returnd data is a PHP Array

## Youtube Data API v3

* [Obtain API key from Google API Console](https://code.google.com/apis/console)

## Contact

For bugs, complain and suggestions please [file an Issue here](https://github.com/madcode-git/youtube/issues) or send email to madcode.git@gmail.com :smile:

## License

This library is licensed under the [MIT License](http://opensource.org/licenses/MIT).
