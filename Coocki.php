<?php
  namespace App\Http\Controllers;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use DateTime;

  class Coocki extends Controller{
    public function one(Request $request){
      date_default_timezone_set('Europe/Minsk');
      // Запишите в куки время захода пользователя на сайт. При следующем заходе выведите на экран сколько времени прошло от предыдущего захода пользователя на сайт.

      if(!isset($_COOKIE['date_now'])){
        setcookie('date_now', date('Y-m-d H:i:s'), time()+3600);
      }else{
        // то что закоментировано неработает, не считывает куку, когда она есть
        //$value = $request->cookie('date_now');

        $now = new DateTime();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $_COOKIE['date_now']);
        $interval = $now->diff($date);

        return "в последний раз вы были сдесь $interval->d дней, $interval->h часов, $interval->i минут, $interval->s секунд назад";
      }
    }

// С помощью формы спросите у пользователя дату рождения. Запишите ее в куки. При заходе на сайт, если сегодня День Рождения пользователя, поздравьте его с этим праздником.
    public function two(Request $request){
      date_default_timezone_set('Europe/Minsk');

      if($request->input('date_happy')){

        $pattern = "/\d{4}\-(\d{2})\-(\d{2})/";
        $date = $request->input('date_happy');

        if(preg_match_all($pattern, $date, $match)){
          setcookie('date_happy', "{$match[1][0]}-{$match[2][0]}", time()+3600);
        }
      }

      if(date('m-d') == $_COOKIE['date_happy']){
        $bar = 'С днём рождения!';
      }else{
        $bar = '';
      }


      return view('test.form2', [
         'foo' => $bar,
      ]);
    }

// Сделайте счетчик обновления страницы, работающий через куки.

    public function three(Request $request){
      if(!isset($_COOKIE['counter'])){
        setcookie('counter', 0, time()+360000);
      }else{
        $counter = $_COOKIE['counter'];
        setcookie('counter', $counter + 1, time()+360000);
        return $_COOKIE['counter'];
      }
    }
  }
