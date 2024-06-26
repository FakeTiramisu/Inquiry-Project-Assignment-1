<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta name="description" content="YNC Finance Software | Do Your Finance Right">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" cotent="Yoojin Ahn">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>About Us | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include_once "header.inc";?>
    <main>
        <section id="about-us">
            <h2 id="highlight">About Us</h2>
            <h1>
                Revolutionizing finance with cutting-edge algorithms for a smarter financial future.
                Discover the innovative minds driving our mission behind the scenes.
            </h1>
        </section>
        <!-- Group Details inside a definition list -->
        <aside id="group-image">
          <figure>
            <img src="images/charmaigne_profile.png" alt="Charmaigne Mamaril profile picture">
            <figcaption>Charmaigne</figcaption>
          </figure>
          <figure>
            <img src="images/ned_profile.jpg" alt="Ned Tonks profile picture">
            <figcaption>Ned</figcaption>
          </figure>
          <figure>
            <img src="images/yoojin_profile.jpg" alt="Yoojin Ahn profile picture">
            <figcaption>Yoojin</figcaption>
          </figure>
        </aside>
        <section id="group-details">
            <h2>Group Details</h2>
            <dl>
                <dt>Group Name</dt>
                <dd>YNC Group</dd>
                <dt>Group ID</dt>
                <dd>Wednesday 10 Kaibin</dd>
                <dt>Tutor Name</dt>
                <dd>Kaibin Wang</dd>
                <dt>Course</dt>
                <dd>COS10026 | Computing Technology Inquiry Project</dd>
            </dl>
        </section>
        <!-- Group Profile and Photos -->
        <section id="team">
            <h2>Get to Know Our Team</h2>
            <!-- Charmaigne Profile -->
            <h3>Charmaigne Mamaril</h3>
            <p>Hi, I&#39;m Charmaigne.</p>
            <p>
                I&#39;ve got limited experience with programming professionally but have been involved in several volunteer 
                game development projects spanning over a decade as both a pixel artist, mapper and quest writer. I hold a 
                Bachelor of Communications (Marketing), with my work experience primarily being in corporate Event Marketing & 
                Workplace Experience.
                I&#39;m a proud cat parent to Bean, a 5-year-old bundle of chaos. 
                In my free time, I love reading and have a wonderful relationship with my kindle. 
                When I&#39;m not buried in a book, you can commonly find me listening to Taylor Swift, 
                SZA or the 1975 or trying out a new restaurant in the city.
            </p>
            <!-- Ned Profile -->
            <h3>Ned Tonks</h3>
            <p>Hi, I&#39;m Ned</p>
            <p>
                I have minimal programming skills which I have learnt from Introduction to Programming 
                and Object-Oriented Programming. I am currently working at Costco in docklands and have 
                been there for 6 months. My hobbies include running, which I am planning to run a marathon 
                at the end of the year, and golf, which is where majority of my money goes! I was born in Melbourne 
                and have lived in Flemington for majority of my life. I have a family of 5 + dog and I am a twin!
            </p>
            <!-- Yoojin Profile -->
            <h3>Yoojin Ahn</h3>
            <p>Hi, I&#39;m Yoojin</p>
            <p>
                I have some past experience in programming language that include Python, C, and SQL. Apart from learning programming languages I'm also fluent in 
                other languages due to travelling a lot since young age. I've lived in Russia, Ukraine, Malaysia, Korea and now in Australia.
                Due to moving so many times I have experienced many diverse cultures which fascinates me every time
                I look back. In my leisure time I usually watch anime, read books, or listen to music. I am also a part of Jazz Band
                where I sing some nice tunes.
            </p>
        </section>
        <!-- Timetable and contact details -->
        <section id="contact-us">
            <h2>Contact Us</h2>
            <p>Don't be Shy. Say Hi!</p>
            <dl>
              <dt>Email</dt>
              <dd>&nbsp;<a href="mailto:104853318@student.swin.edu.au">contact@ync-soft.com</a></dd>
            </dl>
            <p>Address: John St, Hawthorn VIC 3122</p>
        </section>
        <h3> Check Below for Our Availabilites </h3>
        <table>
            <thead>
              <tr>
                <th></th>
                <th>MON</th>
                <th>TUE</th>
                <th>WED</th>
                <th>THU</th>
                <th>FRI</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>08:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>09:00</td>
                <td></td>
                <td></td>
                <td>Inquiry Project<br>Meeting<br></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>10:00</td>
                <td></td>
                <td rowspan="2">Intro to Programming<br>Lecture<br></td>
                <td rowspan="2">Inquiry Project<br>Workshop<br></td>
                <td></td>
                <td rowspan="2">Network &amp; Switches<br>Lecture<br><br></td>
              </tr>
              <tr>
                <td>11:00</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>12:00</td>
                <td>Inquiry Project<br>Lecture Online<br></td>
                <td rowspan="2">Computer Systems<br>Lecture<br></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>13:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>14:00</td>
                <td></td>
                <td rowspan="2">Intro to Programming<br>Tutorial<br></td>
                <td rowspan="3">Network &amp; Switches<br>Lab<br></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>15:00</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>16:00</td>
                <td></td>
                <td></td>
                <td>Club Activities</td>
                <td rowspan="2">Computer Systems<br>Lecture Online<br></td>
              </tr>
              <tr>
                <td>17:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
        </table>
    </main>
    <hr>
    <?php include_once "footer.inc";?>
</body>
</html>
