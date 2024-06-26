<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta name="description" content="YNC Finance Software | Do Your Finance Right">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   cotent="Yoojin Ahn & Charmaigne Mamaril">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Enhancements | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <?php include_once "header.inc";?>
    <main>
        <article class="resource">
            <h2>Enhancement 1: Gradient Background</h2>
            <p>We added a gradient background on the top of index page to create a nice visual.
                We have learned how to apply colored background but it has never been covered in lectures how to make
                gradients using color rgb() element. The code implemented was the linear-graient() function
                with the lines slanted 157 degrees to create a more dynamic feel to the background.
            </p>
            <a class="button" href="index.php">Go to the Enhancement</a>
            <p>Resources for the Gradient Background</p>
            <a class="button" target="_blank" href="https://www.freecodecamp.org/learn/2022/responsive-web-design/learn-css-colors-by-building-a-set-of-colored-markers/step-56">Resource 1</a>
            <a class="button" target="_blank" href="https://cssgradient.io/">Resource 2</a>
        </article>
        <article class="resource">
            <h2>Enhancement 2: @keyframe button gradient animation</h2>
            <p>We added a gradient animation using keyframe to create a fun animated button link to YouTube.
                It is placed at the very bottom of the index.html page that allows to access a YouTube link for 
                our video submission.
               I used the @keyframe rule where animation gradually changes the colors in a rainbow pattern.
            </p>
            <a class="button" href="index.php">Go to the Enhancement</a>
            <p>Resources for the Gradient Background</p>
            <a class="button" target="_blank" href="https://www.w3schools.com/css/css3_animations.asp">Resource 1</a>
        </article>
        <article class="resource">
            <h2>Enhancement 3: Grid & Flex Boxes</h2>
            <p> Grid & Flex Boxes were used to help organize the layout of information on the 'Jobs' page.
                Extra CSS was added to the stylesheet to support the grid layout and flexboxes within the grid. 
                Particularly, a flex box was placed within the grid to organise 'Testimonials'
            </p>                                                                    
            <a class="button" href="jobs.php"> Go to Enhancement</a>
            <p>Resources used to make Grid and Flex boxes</p>   
            <a class="button" target="_blank" href="https://css-tricks.com/snippets/css/complete-guide-grid/">Resource 1</a>
            <a class="button" target="_blank" href="https://css-tricks.com/snippets/css/a-guide-to-flexbox/">Resource 2</a>
        </article>
    </main>
    <hr>
    <?php include_once "footer.inc";?>
</body>
</html>
