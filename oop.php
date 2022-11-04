<?php
/*
 * oop对象编程
 * */

class School{ //学校类 //数学老师 体育老师  电脑老师  //学生
    //属性 1.学校名字 2.学校地址
    public $name;
    public $address='大学';
    private $age=20;
    protected $money='一百万';
    //方法
    function __construct($name){
        $this->name=$name;
        echo $this->computerteacher($name);
        /*
         * 构造方法 每次实例化对象的时候自动执行
         *注意 在其他语言写构造方法和类名一样的方法名就是构造函数(但是在php 不允许！)
         * */
        echo  "欢迎来到学校!"."<hr>"."父类构造方法";
    }
    function __destruct(){
        /*
         * 析构方法 每次对象销毁的时候自动调用
         *
         * 注意 析构函数不能带参数；
         * */
        echo "<br> 恭喜我在".$this->name.$this->address."我毕业了！"."<hr>"."父类析构方法";
    }


    function show(){//展示学校名称

        echo $this->name,$this->address; //两个变量可以用,拼接.
        echo $this->student(); //private 私有的 通过类的内部访问私有方法
        echo $this->property();//protected 受保护
         //这个是public 公共
    }

   public function computerteacher($name=""){//展示学校名称
        return "Hello Wrold!".$name."<br>"; //一个字符串和一个变量拼接用.
    }
    private function student(){
        return "<br>我是private 私有的<br>";
    }
     protected function property(){
      return "<br>我是protected 受保护的<br>";
    }


    /*
     *public 公共  	 在类的内部和外部都能访问(如果方法前面没有public 也是public 因为他是默认的)
     * private 私有的   只能在类的内部访问
     * protected 受保护的 	在整个继承链上访问 (也可以在类的内部访问)
     * */

    //常量

}
//实例化对象

class calssroom extends School{


    /*
     * 继承 关键字 extends
     * calssroom(子类) 继承了 School(父类)
     * 注意:如果父类有构造或者析构方法那么 自己实例化的时候一样调用(分类和继承子类同时实例化的时候都会调用构造和析构方法)
     * */

    public $books;
    function main(){
       //$this->show(); //调用父类public 方法 成功
        //$this->student();//调用父类private方法 失败
        //$this->property();//调用父类protected方法  失败
       //$this->money;//调用父类protected属性 成功
        echo $this->books;
    }

    /*
     * 子类方法重写父类方法
     *子类的方法和父类方法名相同
     * */

    function show(){
        echo "子类的show 方法";
        $this->books;

    }

    function __construct($name,$books){

        /*
         * 子类构造方法
         *如果你要同时是用父类和子类的构造方法 必须 类名::__construct();
         *子类构造父类方法有两种写法
         *
         *1.类名::__construct();
         * 2.parent::__construct(); //parent 关键字表示父类的名字(在类里面使用 类外不能使用)
         * */
        School::__construct($name,$books); //调用父类的钩子方法 如果没得 这个就只能显示子类构造方法
        $this->books=$books;
        //echo "这是子类构造方法";
    }

}


/*
 * 方法修饰符1(static)
 *static、final、abstract
 *static修饰得属性叫静态属性、static修饰得方法叫静态方法
 * 假如我们的类里面静态的成员，我们也必须使用self来调用。
 *(有两种写法 1.类名::属性 2.self::属性) 和前面得子类构造方法共用父类方法使用得parent差不多
 * 调用语法 类名::属性 类名::方法名()
 * **注意：**self表示所在类的类名，使用self降低耦合性(在类里面使用 类外不能使用)
 * */
/*
class Person{

    public static $add="这个一个静态变量";
    static public function show($name){
        echo $name;
    }
}
//echo Person::$add,'<br>';
//Person::show("这是一个静态方法");
class Student{
    private static $num=0; //私有得静态属性 不可以被继承
    public static $name="李四"; //公共得静态属性  可以被继承
    protected static $pass="123456"; //受包含得静态属性 不可以被继承

    public  function __construct(){ //构造函数
        Student::$num++; //调用静态属性 自加
    }
    public function __destruct(){ //析构函数
        self::$num--;//调用静态属性 自减
    }
    public function show(){
        echo '总人数是: '.self::$num;
    }
    private function a(){
        echo '我是私有得普通方法';
    }

    static private function a1(){
        echo '我是私有得静态方法';
    }
    protected function b(){
        echo '我是受保护得普通方法';
    }
   static public function age(){
        echo "18岁";
        self::show();
    }

}

class School1 extends Student{

}

$stu1=new Student();
echo School1::$name;//公共得静态属性 可以被继承
//echo School1::$name1;//私有得静态属性 不可以被继承
//echo School1::$pass; //受保护得静态属性 不可以被继承

//School1::show(); //public 普通公共方法 可以被调用
School1::age(); //public 静态公共方法 可以被调用
//School1::a();//private 普通私有方法 不可以被调用
//School1::a1();//private 私有静态方法 不可以被调用
//School1::b();//private 普通受保护方法 不可以被调用

*/

/*
 * 方法修饰符2(final)
 * final修饰方法不能被重写
 * 1、如果一个类确定不被继承，一个方法确定不会被重写，用final修饰可以提高执行效率。
 * 2、如果一个方法不允许被其他类重写，可以用final修饰。(成员属性不能用findl修饰)
 *
 *下面这个是例子是不能运行得:
 * 因为 findl class Person 这个类 然而下面 又用c子类来继承这个不能findl得父类 Person
 *
 class Person{
    public  $name="李四";
    public  function  show(){
    echo $this->name;
    }

}

class c extends Person{

     public function show(){
         $this->name="王五";
        echo $this->name;
    }
}

$a=new c();
$a->show();

$b=new Person();
$b->show();

*/



/*
 * 方法修饰符3(abstract)
 * 1.abstract修饰的方法是抽象方法，修饰的类是抽象类
 * 2.只有方法的声明没有方法的实现称为抽象方法
 * 3.一个类中只要有一个方法是抽象方法，这个类必须是抽象类。
 * 4.抽象类的特点是不能被实例化
 * 5.子类继承了抽象类，就必须重新实现父类的所有的抽象方法，否则不允许实例化
 * 6.类中没有抽象方法也可以声明成抽象类，用来阻止类的实例化
 *
abstract class Person{
    public abstract function setInfo(); //不能被下面子类所调用
    public function getInfo(){
        echo '获取信息';
    }
}

class Student extends Person{
    public  function setInfo()
    {
        echo '重新实现父类得抽象方法';
    }
}

$stu = new Student();
//$stu1= new Person;// 不能被实例化 因为abstract关键字
$stu->setInfo();
$stu->getInfo();
*/

/*
 * 常量(const-)
 *问题：define常量和const常量的区别？
 * 答：
 * (const 面向对象类中使用  define是在面向过程中使用)
 * const常量可以做类成员，define常量不可以做类成员。
 *
 * 问题：常量和静态的属性的区别？
 * 答：
 * 相同点：都在加载类的时候分配空间
 * 不同点：常量的值不可以更改，静态属性的值可以更改
 *self表示所在类的类名，使用self降低耦合性(在类里面使用 类外不能使用)
 *调用
 * 类名::常量名
 *

class Student{
    const ADD='地址不详';
    function a(){
        echo "我家在哪:".self::ADD;
    }
}
//echo Student::ADD; //常量调用
Student::a();
*/

/*
 * 接口(interface)
 * 1.如果一个类中所有的方法是都是抽象方法（abstract修饰符），那么这个抽象类(abstract)可以声明成接口
 * 2.接口是一个特殊的抽象类，接口中只能有抽象方法(abstract function)和常量(const)
 * 3.接口中的抽象方法只能是public，可以省略，默认也是public的
 * 4.通过implements关键字来实现接口
 * 5.不能使用abstract和final来修饰接口中的抽象方法。
 * 6.类不允许多重继承，但是接口允许多重实现。
 **/

class Person{
    private $name="admin";
    public $pass="123456";
    function __construct()
    {
        echo '我是父类构造函数';
    }
    function show(){
        echo  "我时候父类的show方法";
    }
}
interface IPerson{ //特殊抽象类或接口声明 interface 关键字  注意 接口中只能有抽象方法和常量
    //const ADD1 ='中国'; //常量
    //function fun1(); //接口抽象方法1
    function getId();


}
interface IPerson2{ //特殊抽象类或接口声明 interface 关键字  注意 接口中只能有抽象方法和常量、
    //const ADD2 ='日本'; //常量
    //function fun2();//接口抽象方法2
    function getName();
}
interface IPerson3 extends IPerson,IPerson2{ //特殊抽象类或接口声明 interface 关键字  注意 接口中只能有抽象方法和常量
    /*const ADD3 ='美国'; //常量
    function fun3();//接口抽象方法3*/
    function getPass();
}
/*注意:
*1、在接口的多重实现中，如果有同名的方法，只要实现一次即可
*2、类可以继承的同时实现接口
 * */
class Student extends Person implements IPerson,IPerson2,IPerson3{//Student子类继承父类Person 然后再实现接口
    function __construct()
    {
        Person::__construct();//说白了这个就是静态方法调用函数使得这里会两次构造函数
        echo "我是子类构造函数";
    }

    public function getId()
    {
        echo 111;
    }
    public function getName()
    {
        // TODO: Implement getName() method.
    }
    public function getPass()
    {
        // TODO: Implement getPass() method.
    }
}
#$

/*
class  Student  implements IPerson3{ //接口实现 通过关键字 implements
    const ADD="AAA";

    function getName()
    {
    echo '1';
    }
    function getId()
    {

        echo self::ADD;
    }
    function getPass(){
        echo "123456";
    }
    /*function fun1(){ //必须实现接口里得方法1
        echo '这是'.self::ADD1.'接口方法1';
    }
    function fun2(){//必须实现接口里得方法2
        echo '这是'.self::ADD2.'接口方法2';

    }

}

Student::getPass(); //类实例化静态方法写法

$A = new Student; //类实例化普通方法写法
$A->getPass();*/


//Student::setName("admin");
//Student::getName();


//Student::test();
Person::show(); //普通的类函数也可以是用[函数名::方法名]来耍实例化

//echo Student::ADD1;

//访问接口

//echo IPerson::ADD; //通过接口类访问常量ADD
//echo Student::ADD; //通过子类特殊继承父类访问常量ADD
//Student::fun1(); //过子类特殊继承父类访问 接口方法1


//$chongqiongdaxue = new School("重庆");
//$chongqiongdaxue->name="重庆";
//$chongqiongdaxue->show();
//$chongqiongdaxueyiban = new calssroom("重庆","明朝那些事儿");
//$chongqiongdaxueyiban->student(); //父类方法的私有的 是不会被子类调用
//echo $chongqiongdaxueyiban->show();

//echo "<hr />";
//$beijingdaxue =new School("北京");
//$beijingdaxue->show(); //调用类方法
//echo "<hr />";


?>
