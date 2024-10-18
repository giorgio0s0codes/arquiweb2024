<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8">
        <title>CSS</title>
        <style>
            section {
                color: red;
                font-size: 20px;
                width: 80%;
            }
            p {
                font-style: italic;
                border: 1px solid green;
            }
            .blue{
                color:blue;
            }

            .importante{
                background-color: yellow;
                font-weight: bold;
            }

        </style>
    </head>
    <body>
        <h1>Conceptos CSS</h1>
        <section>
            <p>
            Littering a dark and dreary road lay 
            the past relics of browser-specific tags, 
            incompatible DOMs, broken CSS support, and 
            abandoned browsers.
            We must clear the mind of the past. 
            Web enlightenment has been achieved thanks 
            to the tireless efforts of folk like the W3C, 
            WASP, and the major browser creators.
            </p>

            <p>
                The CSS Zen Garden invites you to relax 
                and meditate on the important lessons 
                of the masters. Begin to see with clarity. 
                Learn to use the time-honored techniques 
                in new and invigorating fashion. 
                Become one with the web.
            </p>

            <p style="margin-bottom: 30px;">
                The CSS Zen Garden invites you to relax 
                and meditate on the important lessons 
                of the masters. Begin to see with clarity. 
                Learn to use the time-honored techniques 
                in new and invigorating fashion. 
                Become one with the web.
            </p>
        </section>
        <article>
            <div class = "blue importante">
                Este texto está afectado por la clase blue
            </div>
        </article>
    </body>
</html>