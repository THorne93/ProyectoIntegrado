<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::insert([
            ["exercise_id" => "1", "prompt" => "Human beings are not the only creatures that like to <strong>(0) ______</strong> fun. Many animals play, as do some birds. However, no other creatures spend so much time enjoying themselves as human beings do. Indeed, we <strong>(1) ______</strong> onto our sense of fun right into adulthood.<br><br>  So why do human beings spend so much time playing? One reason is that we have time for leisure; animals have very little time to play as most of their life is spent sleeping and <strong>(2) ______</strong> food.<br><br>  So, is play just an opportunity for us to <strong>(3) ______</strong> in enjoyable activities, or does it have a more important <strong>(4) ______</strong>? According to scientists, <strong>(5) ______</strong> from being fun, play has several very real <strong>(6) ______</strong> for us – it helps our physical, intellectual, and social development. It also helps to <strong>(7) ______</strong> us for what we have not yet experienced. With very <strong>(8) ______</strong> risk, we can act out what we would do in unexpected, or even dangerous, situations.", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],
            [
                "exercise_id" => "2",
                "prompt" => "Folding bicycles have <strong>(0) .........</strong> around for quite some time now. However, an amazing new
Japanese version <strong>(1) .........</strong> be folded with a swiftness and efficiency never seen before. This bike
is designed <strong>(2) .........</strong> that it is possible to fold it up quickly. Once folded, you pull the bike along <strong>
(3) ........</strong> ease.</br></br>

This remarkable bike has a half-folding frame with a hinge in the middle. And, although the basic idea
is <strong>(4).........</strong> original, its inventor has created an especially clever variation, combining compactness<strong>
(5) ........</strong> convenience with smart design.</br></br>

Recently, folding bicycles <strong>(6) .........</strong> become very popular in Japan, particularly in congested urban
areas like Tokyo, a city <strong>(7) .........</strong> every square centimetre of space is in great demand. Japanese
cyclists need to be able to store their bikes in tiny areas at home or the office. And <strong>(8) .........</strong> they
should want to take their bicycle on the underground, a folding model is a big advantage.",

                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id" => "3",
                "prompt" => "In the last few years, a number of cockery schools have been set <strong>(0) .........</strong> in Ireland to promote
Irish cooking. <strong>(9) .........</strong> such school is run by Kathleen Doyle not <strong>(10).....</strong> from the centre
of Dublin.<br>

'I opened the school twelve years ago; says Kathleen. The school was by no means an overnight
success; I found <strong>(11) ........</strong> necessary to work hard to build up a reputation. One of my advantages
was that I'd had problems with my own cooking. I've made <strong>(12) .........</strong> mistake that it's possible to
make, but <strong>(13) .........</strong> of this, I know what people do wrong from first-hand experience.'<br>

Just <strong>(14) .........</strong> most cookery schools in Ireland, Kathleen initially copied the classical dishes of
France and Italy and other countries <strong>(18) .........</strong> have a reputation for excellent food. ‘Now though,
things are changing,’ says Kathleen. ‘We get excellent produce from Irish farms and, <strong>(16) .........</strong>
result, we're encouraging students to create unique irish dishes.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id" => "4",
                "prompt" => "It <strong>(0) ........</strong> sometimes said that animals use language. Certainly some animal species have
developed amazingly sophisticated ways of communicating with <strong>(1) .........</strong> another.<br><br>

But there are huge differences between the ways animals communicate and the ways human beings
do, When animals make a sound, such <strong>(2).........</strong> a bark or a call, it is in reaction to <strong>(3) ......</strong>
is happening around them. An alarm call means they are frightened. A hunger call means they
want food. Animals, though, cannot make a call meaning ‘I was scared yesterday’ or ‘I'll be hungry
tomorrow', Only human beings are capable <strong>(4) .........</strong> doing this.<br><br>

Zoologists have had some success in teaching human language to animals. <strong>(5) .........</strong> some
famous experiments, chimpanzees have <strong>(6) .........</strong> taught to use their hands to give information
on a range of things. Some animals have even managed to put signs together in <strong>(7) .........</strong> to make
simple sentences. However, getting them to do this takes a huge <strong>(8).........</strong> of training.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id" => "5",
                "prompt" => "Today I am visiting a sweets factory, a building squeezed <strong>(0) .........</strong> a railway line and a canal.
<strong>(1)........</strong> I watch, trucks filled with sugar arrive at the factory where this family-owned company has
been making sweets for some 80 years.<br><br>

Being in a factory <strong>(2)..........</strong> this one is exactly <strong>(3) .........</strong> children dream of. I am staring at huge
vats of sticky liquid <strong>(4) .........</strong> eventually ends up as mouth-watering sweets. Every now <strong>(5) .......</strong>
then I see a factory worker in a white coat put a sweet into her mouth.<br><br>

Ailsa Kelly, granddaughter of the company owner, remembers visiting the factory as <strong>(6)..........</strong> child
with her grandfather. ‘He would take me onto the factory floor and introduce me; she says. ‘He told
me, &quotYou may work here some day.&quot And indeed, she has, continuously, <strong>(7)...............<strong> 1999. The sense
of family is <strong>(8).........</strong> of the reasons employees are remarkably loyal to the company.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id" => "6",
                "prompt" => "Tattoos, <strong> (0)......... </strong> some people call 'body art', have become more and more popular in recent years. In <strong> (1)......... </strong> of the pain caused by having a needle make hundreds of holes in their skin, millions of people <strong> (2)......... </strong> vary widely in age and background are nowadays having their bodies decorated with ink in all kinds of ways.<br><br>
Many of today's young people, <strong> (3)......... </strong> parents were the first generation to experiment with tattoos, see it as a way of expressing their individuality, and in <strong> (4)......... </strong> to do this, they are constantly looking for new styles and designs. <strong> (5)......... </strong> to this increasing demand, tattoo studios have appeared in many towns and villages.<br><br>
<strong> (6)......... </strong> people tend to think of it as a modern practice, tattooing has in fact been around for a long time. There is evidence of tattoos being worn in Siberia over 4,000 years ago, as <strong> (7)......... </strong> as in Ancient Egypt at that time, and it is thought to have existed in Japan 10,000 years ago. Even so, it was not until the late 18th century, when Captain James Cook sailed to Polynesia, that Europeans took an interest.<br><br>
It was on the island of Tahiti, <strong> (8)......... </strong> tattooing had an immportant role in society, that Cook and his crew first saw tattooed men and women, and because of that, the English word comes from the Tahitian word tatau. Ever since then, sailors have had tattoos done, often to show the distant places they have visited.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id" => "7",
                "prompt" => "Tea is an <strong>(0) ______</strong> popular drink with many people. It is estimated that the consumption of tea in England alone exceeds 165 million cups daily. Despite this, the drink was virtually <strong>(1) ______</strong> in England until about 400 years ago. The first <strong>(2) ______</strong> to tea in England comes in a diary written in 1660. However, its <strong>(3) ______</strong> really took off after the <strong>(4) ______</strong> of King Charles II to Catherine of Braganza. It was her great love of tea that made it <strong>(5) ______ </strong>.<br><br>

It was believed that tea was good for people as it seemed to be capable of reviving the spirits and curing certain minor <strong>(6) ______</strong> . It has even been suggested by some historians that it played a significant part in the Industrial Revolution. Tea, they say, increased the number of hours that <strong>(7) ______</strong> could work in factories as the caffeine in tea made them more <strong>(8) ______</strong> and consequently able to work longer hours.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"They didn't sell many programmes at the match.",
                "before_prompt"=>"Very",
                "after_prompt"=>"at the match last Saturday.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"We got to work late because we decided to drive rather than take the train.",
                "before_prompt"=>"We got to work late because we decided to drive",
                "after_prompt"=>"the train.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"Last Friday was the first time my car ever broke down, even though it is very old.",
                "before_prompt"=>"Until last Friday, my car",
                "after_prompt"=>"down, even though it is very old.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"All your complaints will be investigated by my staff tomorrow, said the bank manager.",
                "before_prompt"=>"The bank manager promised that his staff",
                "after_prompt"=>"all our complaints the next day.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"Last year the heavy rain caused the postponement of the tennis tournament.",
                "before_prompt"=>"Last year the tennis tournament",
                "after_prompt"=>"so heavily.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],
            [
                "exercise_id"=>"8",
                "prompt"=>"Jack does not want to work for his uncle any longer.",
                "before_prompt"=>"John does not want",
                "after_prompt"=>"for his uncle.",
                "is_multiple_choice" => false,
                "created_at"=> now()
            ],



            

        ]);
    }
}
