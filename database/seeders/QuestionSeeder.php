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

            ////// PART 1 ////////
            ["exercise_id" => "1", "prompt" => "Human beings are not the only creatures that like to <strong>(0) ______</strong> fun. Many animals play, as do some birds. However, no other creatures spend so much time enjoying themselves as human beings do. Indeed, we <strong>(1) ______</strong> onto our sense of fun right into adulthood.<br><br>  So why do human beings spend so much time playing? One reason is that we have time for leisure; animals have very little time to play as most of their life is spent sleeping and <strong>(2) ______</strong> food.<br><br>  So, is play just an opportunity for us to <strong>(3) ______</strong> in enjoyable activities, or does it have a more important <strong>(4) ______</strong>? According to scientists, <strong>(5) ______</strong> from being fun, play has several very real <strong>(6) ______</strong> for us – it helps our physical, intellectual, and social development. It also helps to <strong>(7) ______</strong> us for what we have not yet experienced. With very <strong>(8) ______</strong> risk, we can act out what we would do in unexpected, or even dangerous, situations.", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],
            ["exercise_id" => "2", "prompt" => "<p>After a short time living in a foreign country, I noticed conversations with locals assumed a <strong>(0)........ </strong>pattern. There were standard answers to the usual questions. Most questions caused little <strong>(1).........</strong> - it was rather like dancing, where both partners know how to avoid <strong>(2)..........</strong> on each other's toes.</p><p><br></p><p>But, 'When are you going home?' was a question I <strong>(3).........</strong> to answer, whenever I <strong>(4)..........</strong> my life and the direction it seemed to be <strong>(5)..........</strong> . In the last ten years, I had lived in a dozen countries. And I had travelled through dozens more; usually in <strong>(6).........</strong> of a purpose or a person; occasionally to see the attractions.</p><p><br></p><p>This kind of travel is not <strong>(7).........</strong> wandering, but is the extensive exploration of a wide <strong>(8)........... </strong>of cultures. However, it doesn't allow you to put down roots. At the back of your mind, though, is the idea of home, the place you came from.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],
            ["exercise_id" => "3", "prompt" => "<p>The editors of a new online dictionary are <strong>(0)........</strong> the public to submit words that they would like to see in the dictionary. People are already sending in words, some of which they have <strong>(1).........</strong> themselves - these will almost certainly not <strong>(2).........</strong> in the dictionary!</p><p><br></p><p>When a new word is submitted, editors check newspapers, radio, television and social networks to see how <strong>(3)........</strong> the word is used. They also <strong>(4)........ </strong>whether the word is likely to remain in use for more than one or two years. The evidene they collect will help them decide whether or not to put it in the dictionary.</p><p><br></p><p>Editors will <strong>(5)......... </strong>feedback on any words submitted by the public. Even words not accepted will <strong>(6)......... </strong> to be monitored over the following year. Editors need to be <strong>(7).........</strong> of new words which emerge from areas such as popular culture and technology, so that their dictionary is a genuine <strong>(8)......... </strong>of the current language. </p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],
            ["exercise_id" => "4", "prompt" => "<p>Memory is at the <strong>(0).........</strong> of our sense of personal identity. If we did not have memory, we would not be <strong>(1).........</strong> of our relationships with other people and would have no <strong>(2)......... </strong>that we had had any past at all. And without memory we would have no knowledge on which to <strong>(3).........</strong> our present and future.</p><p><br></p><p>Memory <strong>(4)......... </strong>of three processes: registration, retention and recall. Registration when we consciously notice something. Retention is the next <strong>(5).........</strong> , when we keep something we have noticed in our minds for a certain period of time. Finally, recall occurs when we actively think about some of these things that are <strong>(6).........</strong> in our minds.</p><p><br></p><p>Every day we are subjected to a vast <strong>(7)........ </strong>of information. If we remembered every <strong>(8).........</strong> that we had ever seen or heard, life would be impossible. Consequently, our brains have learnt to register only what is of importance.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],
            ["exercise_id" => "5", "prompt" => "<p>Official figures show that the number of people <strong>(0).........</strong> international flights is decreasing, and this is <strong>(1).........</strong> in significant changes to holidaying habits.</p><p><br></p><p>As the cost of air tickets increases, it appears that more and more families are choosing to <strong>(2).........</strong> their summer holidays at home. People are also becoming more <strong>(3).........</strong> of the harm that flying does to the environment, and see it as a way of helping to <strong>(4).........</strong> the planet, too.</p><p><br></p><p>For many parents a summer with no airport queues or overcrowded resorts may seem attractive, but the idea might well be less <strong>(5).........</strong> with their teenage children, who are probably <strong>(6).........</strong> to flying off to the Mediterranean of Miami as soon as school breaks up. So, the question is, how can young people have lots of fun when so much will be closed for the holidays, and so many of their friends are bound to be away?</p><p><br></p><p>The answer may lie at the local sports centre. Nowadays, many centres organise summer activities aimed at young people <strong>(7).........</strong> either on indoor or outdoor sports. These might range, for instance, from playing table tennis to going mountain-biking. As well as being healthy and enjoyable, taking part in activities like these is also an excellent way to <strong>(8).........</strong> new friends. For the most popular activities, though, it is advisable to apply early for a place - perhaps two or three months in advance.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => true, "created_at" => now()],


            /////// PART 2 ///////
            [
                "exercise_id" => "6",
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
                "exercise_id" => "7",
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
                "exercise_id" => "8",
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
                "exercise_id" => "9",
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
                "exercise_id" => "10",
                "prompt" => "Tattoos, <strong> (0)......... </strong> some people call 'body art', have become more and more popular in recent years. In <strong> (1)......... </strong> of the pain caused by having a needle make hundreds of holes in their skin, millions of people <strong> (2)......... </strong> vary widely in age and background are nowadays having their bodies decorated with ink in all kinds of ways.<br><br>
Many of today's young people, <strong> (3)......... </strong> parents were the first generation to experiment with tattoos, see it as a way of expressing their individuality, and in <strong> (4)......... </strong> to do this, they are constantly looking for new styles and designs. <strong> (5)......... </strong> to this increasing demand, tattoo studios have appeared in many towns and villages.<br><br>
<strong> (6)......... </strong> people tend to think of it as a modern practice, tattooing has in fact been around for a long time. There is evidence of tattoos being worn in Siberia over 4,000 years ago, as <strong> (7)......... </strong> as in Ancient Egypt at that time, and it is thought to have existed in Japan 10,000 years ago. Even so, it was not until the late 18th century, when Captain James Cook sailed to Polynesia, that Europeans took an interest.<br><br>
It was on the island of Tahiti, <strong> (8)......... </strong> tattooing had an immportant role in society, that Cook and his crew first saw tattooed men and women, and because of that, the English word comes from the Tahitian word tatau. Ever since then, sailors have had tattoos done, often to show the distant places they have visited.",
                "before_prompt" => "null",
                "after_prompt" => "null",
                "is_multiple_choice" => false,
                "created_at" => now()
            ],

            /////// PART 3 ///////
            ["exercise_id" => "11", "prompt" => "Tea is an <strong>(0) ______</strong> popular drink with many people. It is estimated that the consumption of tea in England alone exceeds 165 million cups daily. Despite this, the drink was virtually <strong>(1) ______</strong> in England until about 400 years ago. The first <strong>(2) ______</strong> to tea in England comes in a diary written in 1660. However, its <strong>(3) ______</strong> really took off after the <strong>(4) ______</strong> of King Charles II to Catherine of Braganza. It was her great love of tea that made it <strong>(5) ______ </strong>.<br><br> It was believed that tea was good for people as it seemed to be capable of reviving the spirits and curing certain minor <strong>(6) ______</strong> . It has even been suggested by some historians that it played a significant part in the Industrial Revolution. Tea, they say, increased the number of hours that <strong>(7) ______</strong> could work in factories as the caffeine in tea made them more <strong>(8) ______</strong> and consequently able to work longer hours.", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "12", "prompt" => "<p>Elite <strong>(0).........</strong> like the Jamaican Usain Bolt have regularly been clocked running at nearly 45 kilometres per hour. Such speed would have seemed <strong>(1).........</strong> not so long ago. Scientists now suggest that humans can move <strong>(2).........</strong> faster than even that, perhaps as fast as 65 kilometres per hour.</p><p><br></p><p>For years, it was assumed that simple muscle power determined human speed, but recent research suggest otherwise. The most important <strong>(3).........</strong> factor appears to be how quickly the muscles can contract and thus <strong>(4).........</strong> the time a runner's foot is in contact with the ground.</p><p><br></p><p>Is our athletic ability inherited? Researcher Alun Williams has <strong>(5).........</strong> twenty-three inherited factors that influence sporting performances, such as the <strong>(6).........</strong> use of oxygen, and strength. As world population rises, predicts Williams, the <strong>(7).........</strong> of there being someone with the right genes for these twenty-three <strong>(8).........</strong> will increase noticeably and thus faster runners are likely to emerge in the future.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "13", "prompt" => "<p>I have been a keen <strong>(0).........</strong> for about nine years. When I began cycling, I found the flat roads easy but the hills almost <strong>(1).........</strong> . Surprisingly, now it's the opposite. A long flat ride can be both dull and <strong>(2).........</strong> as you never experience that fantastic feeling of freedom when speeding downhill. Years ago, going uphill left me <strong>(3).........</strong> . Now I have learned to take hills slowly and steadily.</p><p><br></p><p>When I set off, I'm full of energy and the first hundred metres are <strong>(4).........</strong> , the next couple of kilometres are a bit tiring but on the whole the experience is very <strong>(5).........</strong> .</p><p><br></p><p>Cycling is <strong>(6).........</strong> any other forms of exercise I have tried; it is never a chore but always a <strong>(7).........</strong> . The physical benefits are obvious but the mental benefits are <strong>(8).........</strong> important; when you are travelling calmly at a sensible speed, you breathe fresh air, have time to think and can relax.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "14", "prompt" => "<p>Most people feel rather <strong>(0).........</strong> when they go for an interview for a new job. This is not surprising as getting a job one wants is important. People being interviewed expected the interviewers to be <strong>(1).........</strong> , matching an applicant against a job <strong>(2).........</strong> . However, what often happens in reality is that the interviewers make <strong>(3).........</strong> that are little more than reactions to the <strong>(4).........</strong> of the applicant.</p><p><br></p><p>Even skilled interviewers may, without realisig it, <strong>(5).........</strong> favour people who make them feel at <strong>(6).........</strong> . With this in mind, if you go for an interview you should try to make a good impression from the start by presenting the interviewers with the very best version of yourself, emphasising the <strong>(7).........</strong> of skills you have. You must appear very positive and as <strong>(8).........</strong> as possible. It is for you to convince the interviewers that you are definitely the most suitable person for the job.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "15", "prompt" => "<p>According to experts, doing puzzles keeps our brains fit and <strong>(0).........</strong> . As well as gaining <strong>(1).........</strong> from finding the correct answer to a difficult problem, we give our brains a good workout in the process. To help us do this, all sorts of handheld 'brain games' are now available in the shops, and the most <strong>(2).........</strong> games have sold in their millions.</p><p><br></p><p>What's more, people <strong>(3).........</strong> that the more they play the games, the easier it is to find a <strong>(4).........</strong> to the problems posed. They see this as proof that there has been an <strong>(5).........</strong> in the power of their brains. Unfortunately, however, this may be a false impression.</p><p><br></p><p>Some <strong>(6).........</strong> argue that the brain gets better at any task the more often  it is repeated. In other words, the improvement in the <strong>(7).........</strong> of the brain is something that happens naturally.</p><p><br></p><p>So although these brain games are obviously fun to play, it remains <strong>(8).........</strong> whether they are actually helping to boost brainpower or not.</p>", "before_prompt" => "null", "after_prompt" => "null", "is_multiple_choice" => false, "created_at" => now()],

            /////// PART 4 ///////
            ["exercise_id" => "16", "prompt" => "They didn't sell many programmes at the match.", "before_prompt" => "Very", "after_prompt" => "at the match last Saturday.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "16", "prompt" => "We got to work late because we decided to drive rather than take the train.", "before_prompt" => "We got to work late because we decided to drive", "after_prompt" => "the train.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "16", "prompt" => "Last Friday was the first time my car ever broke down, even though it is very old.","before_prompt" => "Until last Friday, my car","after_prompt" => "down, even though it is very old.","is_multiple_choice" => false,"created_at" => now()],
            ["exercise_id" => "16","prompt" => "All your complaints will be investigated by my staff tomorrow, said the bank manager.","before_prompt" => "The bank manager promised that his staff","after_prompt" => "all our complaints the next day.","is_multiple_choice" => false,"created_at" => now()],
            ["exercise_id" => "16","prompt" => "Last year the heavy rain caused the postponement of the tennis tournament.","before_prompt" => "Last year the tennis tournament","after_prompt" => "so heavily.","is_multiple_choice" => false,"created_at" => now()],
            ["exercise_id" => "16","prompt" => "Jack does not want to work for his uncle any longer.","before_prompt" => "John does not want","after_prompt" => "for his uncle.","is_multiple_choice" => false,"created_at" => now()],

            ["exercise_id" => "17", "prompt" => "Robert had never been to Turkey on business before...", "before_prompt" => "It", "after_prompt" => "Robert had ever been to Turkey on business.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "17", "prompt" => "It was impossible for me to know which road to follow", "before_prompt" => "I", "after_prompt" => "known which road to follow", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "17", "prompt" => "So far this year the cost of petrol has not increased.", "before_prompt" => "So far this year there", "after_prompt" => "in the cost of petrol.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "17", "prompt" => "I cannot get all my clothes in the suitcase.", "before_prompt" => "The suitcase", "after_prompt" => "take all my clothes.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "17", "prompt" => "The waiter carried the tray very carefully so that he wouldn't spill any of the drinks.", "before_prompt" => "The waiter carried the tray very carefully so", "after_prompt" => "any of the drinks.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "17", "prompt" => "I wasn't able to get to the airport on time because of the bad weather.", "before_prompt" => "The bad weather", "after_prompt" => "to the airport on time.", "is_multiple_choice" => false, "created_at" => now()],
            
            
            ["exercise_id" => "18", "prompt" => "My brother doesn't play tennis now as well as he used to.", "before_prompt" => "My brother used to", "after_prompt" => "does now.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "18", "prompt" => "Clothing companies are selling an increasing number of goods on the internet.", "before_prompt" => "An increasing number of goods", "after_prompt" => "clothing companies on the internet.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "18", "prompt" => "'Well done for scoring twice, Mark' said the coach.", "before_prompt" => "Mark", "after_prompt" => "for scoring twice.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "18", "prompt" => "You are welcome to contact me if you need more information.", "before_prompt" => "Please feel free", "after_prompt" => "me if you need more information.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "18", "prompt" => "Tickets for the concert cannot be bought before 12th May.", "before_prompt" => "Tickets for the concert will not", "after_prompt" => "12th May.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "18", "prompt" => "I didn't buy the camera because it was so expensive.", "before_prompt" => "I would have bought the camera", "after_prompt" => "so expensive.", "is_multiple_choice" => false, "created_at" => now()],
          
            ["exercise_id" => "19", "prompt" => "'Do you know the cost of the trips?' asked Pamela.", "before_prompt" => "Pamela asked if I knew", "after_prompt" => "were.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "19", "prompt" => "During the quiz, I could not think of the correct answer to the winning question.", "before_prompt" => "During the quiz, I was not", "after_prompt" => "the correct answer to the winning question.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "19", "prompt" => "I promised that I would think  carefully about the job offer.", "before_prompt" => "I promised", "after_prompt" => "the job offer.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "19", "prompt" => "The group continued to walk despite rain starting to fall.", "before_prompt" => "The group carried", "after_prompt" => "started to rain.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "19", "prompt" => "Almost all the tickets for next Saturday's concert have been sold.", "before_prompt" => "There are", "after_prompt" => "for next Saturday's concert.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "19", "prompt" => "Do you think it is likely that Peter will get the job he has applied for?", "before_prompt" => "Do you think that Peter has", "after_prompt" => "the job he has applied for?", "is_multiple_choice" => false, "created_at" => now()],
          
            ["exercise_id" => "20", "prompt" => "In 2009 I went to Shanghai and I will never forget it.", "before_prompt" => "I", "after_prompt" => "to Shanghai in 2009.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "20", "prompt" => "It was foolish of you to ride your bike so fast.", "before_prompt" => "You", "after_prompt" => "your bike so fast.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "20", "prompt" => "There was no point in staying at the part because my friends had left.", "before_prompt" => "My friends had left the party so", "after_prompt" => "there.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "20", "prompt" => "It's possible that the thieves hid the money in the countryside.", "before_prompt" => "The thieves", "after_prompt" => "the money in the countryside.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "20", "prompt" => "The climbers continued to go up the mountain even though it was snowing.", "before_prompt" => "The climbers", "after_prompt" => "the mountain even though it was snowing.", "is_multiple_choice" => false, "created_at" => now()],
            ["exercise_id" => "20", "prompt" => "There isn't much chance of the weather improving today.", "before_prompt" => "The weather", "after_prompt" => "today.", "is_multiple_choice" => false, "created_at" => now()],
        ]);
    }
}
