<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        var test = (function () {
            var counter = 0;

            var addCounter = function () {
                counter++;
            }

            var zeroCounter = function () {
                console.log("Counter Before Reset:" + counter);
                counter = 0;
                console.log("Counter after Reset:" + counter);

            }
            return {
                incrementCounter: addCounter,
                resetCounter: zeroCounter
            };

        })();

        test.incrementCounter();
        test.incrementCounter();
        test.incrementCounter();

        test.resetCounter();
    </script>
</body>

</html>