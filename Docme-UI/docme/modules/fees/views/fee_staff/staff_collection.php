<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    //    $search_image = base_url('assets/img/searchicon.jpg');
                    //    $advancedsearch = base_url('assets/img/advancedsearch.jpg');
                    $student_img = base_url('assets/img/a4.jpg');
                    ?>
                    <!--                     <div class="image">
                                            <img alt="image" class="img-responsive" src="<?php echo $img1; ?>">
                                        </div>-->
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row m-b-sm m-t-sm" id="search-feecode">


                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="profile-image">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCABiAEgDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD3+iiigAoqlq2q2mi6dLfXsmyKP82PYD3NeLeIviVquuyva2Aa2tjwUib5mHue/wCFA0mz2x9SsI7k20l5brOBny2kAbH0qwjpIoZGVlPQqcivmuHTtUnuAZVkXec5IOTWnpev6t4VvN8UhUE/NE2Srj0IqVJMt02kfQdFYXhjxRaeJrJpYVMU8eBLCxyVz0IPcGt2qMwooooAKKKKAPKfi601zf6Vp6uyxsrvjPG7OM/UD+Zpmg+HrOwgiUQIZDgszDJzV3xnAt747tA0m5Le03FB/Cdx/wDrVV/txLeQjyPMI7GUKT9K5KzblZHoUYpQudEbNF/hX8qzdV0W1vrYrNGrZ6ccj8avadq1vqUW4RyQsv3lfBx+VUbnXbEztAkdy7qeWVBt/Mmsmuxr6nMeHZn8J+Lrcs7C1lbypM/3WPH64Ne2141rCrd3umvGpIe6jjZSMHlhxXstdVGTlHU4sRBRasFFFFbHOFFFFAHm2sWYh8UXswA3SDGe5yc1nN4ejum/eQrJ86yDcufmHT8OenQ11Pi2B4rpLsKuxgFzu5LfT6VRttQQW+CwUnue1cM/dmelSfNApWdr9ma7AYKSCG2jgE1mXGgl5IZsZMYY7d5AkyOM+uOo6VrD7TEkyRS27+Zx8wPP1q+k0cdosUjKzKOoqL2dzVnPrZTRtpoEmJYLlZFJGc7RXrVcPocMd/rKAkYhHm49ecD9a7iuqhe1zhxLTkFFFFbnMFFZOr+JtG0IoupX8cLv92PlmP4DJxXJ658WdL08qmn2s15J1YuDCoH4jJ/KqUJPZAcn498Q6hZ/EUR3G9LONFjiibo6tjJH49/atGN47sG3kAKk8g1janJdeNpodY1IokULYht40wUGcgEnk+ua05bYnbMpKn+8K4K7Tlp0PQwyahr1LJ8OMilUiTyzz5m45pkjwafAytI3lxgszOxPAHNMZ9SCEC6ymP7tV306SSzl+0FnEqFDn0PFZOV9zqbbWrOo+HnjGy1bzdKZfKuEZnhB/wCWif4ivQK+dfDU8Ph/xWNRtoJrm1smZTucA8gg49e9epWfxS0W7di1teQwhgvmyKuPyDZr0oxdjx6jtLU7iimRTRToHhkSRDyGRgQfxFFBJ8wajeT30gnkiHy4DSAElj7seppbxr+4tYZbrc0XPluQOfypkupSx6fJZ4Tyz8uTnOOuPSo0F1PZFgJGgQZIzwPWvQtbdJEJNWUTqPCc95HeRwXnNpcLsjJYHDYyv5jNegppy42dVIrxoT6hHbQzLJJ5ETAoeykHj9a9VsPG2jSWUUk80iSFQWHlHg9xXmYmg+bmtv2OqniKdONpSsXTo75AJGwe9Zfii4/s3RpHQfvWxHEo7sa61JoZoUmjdWjdQysDwRXkvjXxCdQ1tYbY4gsmwv8AtP3P9Kxo0OedjpnUtG5hWdpeLJNApdHYAMm7731qtHaTytII13eVkuQegqy0lxdzIA58yZsZxtz/APWp6CexmltoJAzSYVtq89P06mvUUmvU8+Xm9C3o9/qliVvbO9kgFuRhfM6+2OhHtRWfHbzSXDiNR+65YE4xiih8l9TFKfR6DZ5oLDVWaHFxARgA89V/oagtb2eNJIochHJDIFBqS5tY4reG6MiyoWUtGMggdxQ95b298JLDAATkFSAfzqtNrXGmnecdyHzrkWctum8wA7mXbkD/AAq3Yu32fcFPlk/e7ZA6VBa6pJbGYhUbzTlg2cA/nUVvNPDvgQMY2+cKBnkU5JtPQxxFFVKbitzuf+Epn8P295pYj80qMQMxwYzgZ+o5z9a5W4uoriyjhSPEijLPgDJ5yffOamvr5dVsxqF1Ki3HlhERSOi/KN3csQCapQrDJbbIgZLt2+VewHcmsoQgryt1NKTnSpKM3f8AQS7upLhoQ6CNIkwpXqfelN00N+JLUeWRgLgZPTr9e9NullSbc5X9ycYx+g/WrUl1b21zaSwW4DRr/EfvHHWr6aIvT4UtCubi5guXUF0aUfPkcnJ96KnfU2ku53MSkyRhBkk7f8TRQvNCvKOi2M65UZ6DoO1Fuim6QbRjcO3vRRVhH4jplt4f+EkRPJj2eU/y7RjgnFZyqq6/hQAPMIwB2oorGPwfIH/GMiRFF042jG9uMe9aekgC+JAAIXgjtRRW0vhFU+Flef5rq53c855+tWvLRtUsgyKQeoI68UUVA4/B8gEUZ1WdTGu0HgY4FFFFRM2hsf/ZAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==" class="img-md" alt="profile">
                                </div>
                                <div class="profile-info">
                                    <div class="">
                                        <div>
                                            <h2 class="no-margins">
                                                <!--Adiba Aktar Eva Ibrahim-->
                                            </h2>
                                            <h4>AATEKA RIZWAN KHAN </h4>
                                            <!--<h4>40153/17</h4>-->
                                            <small>

                                                Employee Code:56859
                                            </small><br>
                                            <small>

                                                Head Mistress
                                            </small><br>
                                            <!--                                <small>
                                   
                                 Batch :  KG1/A/CBS/FN/ENG/2017-18
                                </small><br>
                                <small>
                                    Class : KGI
                                </small>-->
                                            <!--                                <small>
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered alteration in some form Ipsum available.
                                </small>-->

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="col-md-4" style="padding-top:5px;float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important;">
                                        <h1 class="m-xs"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF "></span> 4540.00</h1>
                                        <input type="hidden" value="0" id="final_total_payable_amt" name="final_total_payable_amt">
                                        <h3 class="font-bold no-margins" style="padding-top:10px !important; padding-bottom: 10px !important;">
                                            Gross Amount
                                        </h3>
                                        <small style="padding-top:5px;">Total amount due</small>
                                    </div>

                                </div>
                            </div>

                            <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                        <div class="input-group m-b">
                                            <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true" style="color:hotpink;font-size: 20px; "></i> </span>
                                            <input type="text" placeholder="Enter amount wish to pay" class="form-control" name="payable_fee" id="payable_fee">
                                            <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;" type="button" onclick="pay_atom('AE/18/985')" class="btn btn-primary">Distribute
                                                </button> </span>
                                        </div>
                                        <!--                                    <span class="text-muted small">
                                        *Fees Distributed will be reflected in the below table of fee head's  </span>-->
                                    </div>
                                </div>


                                <hr>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="curd-content" style="display: none;"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_country">

                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Month</th>
                                                    <th>Fee Description </th>
                                                    <th>Amount</th>
                                                    <th>Amount Wish to pay</th>
                                                    <!--<th>Task</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($country_data) && !empty($country_data) && is_array($country_data)) {
                                                    foreach ($country_data as $country) {
                                                ?>
                                                        <tr>
                                                            <td> <?php echo $country['country_name']; ?></td>
                                                            <td> <?php echo $country['country_abbr']; ?></td>
                                                            <td> <?php echo $country['country_nation']; ?></td>
                                                            <td> <?php echo $country['currency_name']; ?></td>


                                                            <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                                <?php if ($country['isactive'] == 1) { ?>
                                                                    <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $country['country_id'] ?>', this)" checked id="t1" />


                                                                <?php } else {
                                                                ?>
                                                                    <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $country['country_id'] ?>', this)" id="" class="js-switch" />

                                                                <?php }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0);" onclick="edit_country('<?php echo $country['country_id']; ?>', '<?php echo $country['country_name']; ?>', '<?php echo $country['country_abbr']; ?>', '<?php echo $country['country_nation']; ?>', '<?php echo $country['currency_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $country['country_name']; ?>" data-original-title="<?php echo $country['country_name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <!--<div class="panel panel-info">-->
                                <!--                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Transaction Types
                    </div>-->
                                <!--<div class="panel-body">-->
                                <!--<div class="panel-group payments-method" id="accordion">-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <i class="fa fa-money text-info"></i>
                                        </div>
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Cash Payment</a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group " style="padding-left: 30px;padding-right: 30px;">
                                                    <label>Amount Total</label>
                                                    <input type="text" style="background-color: #FFFFFF;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="Rs 4540.00">
                                                </div>
                                                <hr>
                                                <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="cash_pay();">
                                                    <i class="fa fa-money">
                                                        Make a payment!
                                                    </i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <i class="fa fa-money text-sucess"></i>
                                        </div>
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Cheque Payment</a>
                                        </h5>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Cheque Number</label>
                                                        <input type="text" class="form-control" maxlength="10" name="ChequeNumber" id="ChequeNumber" placeholder="Enter Cheque Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Cheque Date</label>
                                                        <input type="text" class="form-control" name="ChequeDate" readonly="" style="background-color:white;" id="ChequeDate" placeholder="Enter Cheque Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name of Drawer</label>
                                                        <input type="text" class="form-control" name="NameofDrawer" maxlength="100" id="NameofDrawer" placeholder="Enter Drawer Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Drawer Address</label>
                                                        <input type="text" class="form-control" name="DrawerAddress" id="DrawerAddress" placeholder="Enter Drawer Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name of Bank</label>
                                                        <input type="text" class="form-control" name="NameofBank" maxlength="30" id="NameofBank" placeholder="Enter Drawee Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Bank Branch</label>
                                                        <input type="text" class="form-control" name="BranchBank" maxlength="25" id="BranchBank" placeholder="Enter Drawee Address">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group ">
                                                        <label>Amount Total</label>
                                                        <input type="text" style="background-color: #FFFFFF;" class="form-control" disabled="" name="pay_amount1" id="pay_amount1" value="Rs 4540.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12">
                                                <div class="row">
                                                    <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:30px;" href="javascript:void(0)" onclick="cheque_pay();">
                                                        <i class="fa fa-money">
                                                            Make a payment!
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <i class="fa fa-cc-amex text-success"></i>
                                            <i class="fa fa-cc-mastercard text-warning"></i>
                                            <i class="fa fa-cc-discover text-danger"></i>
                                        </div>
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Card Payment</a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form role="form" id="payment-form">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-success">
                                                                <label>CARD NUMBER</label>
                                                                <input type="text" id="CardNumber" name="CardNumber" class="form-control" data-mask="XXXX-XXXX-XXXX-9999" placeholder="Enter Card Number">
                                                                <!--                                                            <input type="number" class="form-control" name="CardNumber" maxlength="16" id="CardNumber" placeholder="Enter Card Number"/>-->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group has-success">
                                                                <label>NAME AS ON CARD</label>
                                                                <input type="text" class="form-control" name="NameOfCard" id="NameOfCard" placeholder="Enter name as on card">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group ">
                                                                <label>Amount Total</label>
                                                                <input type="text" style="background-color: #FFFFFF;" class="form-control" disabled="" name="pay_amount2" id="pay_amount2" value="Rs 4540.00">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <a class="btn btn-info" id="card_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="card_pay();">
                                                                <i class="fa fa-money">
                                                                    Make a payment!
                                                                </i>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--</div>-->
                                <hr>
                            </div>
                            <!--</div>-->
                        </div>

                        <!--<div class="row">-->

                        <?php
                        $breaker = 0;
                        //                                if (isset($feedback_subject_data) && !empty($feedback_subject_data)) {
                        //                                    foreach ($feedback_subject_data as $subject_data) {
                        ?>
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                            <div class="ibox-content">

                                <div>

                                </div>

                            </div>

                        </div>
                        <?php
                        if ($breaker == 3) {
                            echo '<div class="clearfix"></div>';
                            $breaker = 0;
                        } else {
                            $breaker++;
                        }
                        //                                    }
                        //                                }
                        ?>
                    </div>
                    <!--</div>-->
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
    var list_switchery = [];
    var table = $('#tbl_country').dataTable({

        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 4
            },
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        },

    });
    $('#tbl_country tbody').on('click', function(e) {
        activateSwitchery()
    });

    $(document).ready(function() {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_country_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_country_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_country();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_country_add();">NEW COUNTRY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(country_id, element) {
        //        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'country/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "country_id": country_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Country Updated', 'Country Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Country Updated', 'Country Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            gs_count();
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            //                            window.location.href = baseurl + "country/show-country";
                            load_country();
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        }

                    }
                }
            }
        });
    }

    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/add-country/';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
        var country_nation = $("#country_nation").val();



        if (country_name == '') {
            swal('', 'Country Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_name.length > '30') || (country_name.length < '3')) {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_name").val())) {
            swal('', 'Country Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (country_abbr == '') {
            swal('', 'Country Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_abbr.length > '15') || (country_abbr.length < '2')) {
            swal('', 'Country Abbreviation should contain letters 2 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#country_abbr").val())) {
            swal('', 'Country Abbreviation can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (currency_name == -1) {
            swal('', 'Currency is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }

        if (country_nation == '') {
            swal('', 'Nationality is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_nation.length > '30') || (country_nation.length < '3')) {
            swal('', 'Nationality should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_nation").val())) {
            swal('', 'Nationality can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    gs_count();
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            country_data = JSON.parse(result);

                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_country').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Country, ' + country_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/edit-country';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
        var country_nation = $("#country_nation").val();
        if (currency_name == -1) {
            swal('', 'Currency is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (country_name == '') {
            swal('', 'Country Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_name.length > '30') || (country_name.length < '3')) {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_name").val())) {
            swal('', 'Country Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (country_abbr == '') {
            swal('', 'Country Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_abbr.length > '15') || (country_abbr.length < '2')) {
            swal('', 'Country Abbreviation should contain letters 2 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#country_abbr").val())) {
            swal('', 'Country Abbreviation can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (country_nation == '') {
            swal('', 'Nationality is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_nation.length > '30') || (country_nation.length < '3')) {
            swal('', 'Nationality should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_nation").val())) {
            swal('', 'Nationality can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            country_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_country').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Country ' + country_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }

    function edit_fee_code1() {
        var ops_url = baseurl + 'fees/edit-feescode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#paymentmode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function edit_fee_type() {
        var ops_url = baseurl + 'fees/edit-feetype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_country() {
        $('#search-feecode').show();
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_fee_type() {
        var ops_url = baseurl + 'fees/add-feetype';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
</script>