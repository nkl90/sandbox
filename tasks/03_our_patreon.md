### Задание №3. Разработка системы распростронения контента по платной подписке

Необходимо разработать систему распростронения контента по платной подписке aka Patrion.
К сожалению, мне неудалось найти бесплатного тестового API для осуществления операций
с карточными данными подписчиков и контентмэйкеров, поэтому реализация этой части системы
не предусматривается.

Система состоит из следующих страниц:
- Главная страница (контент-лента)
- Страница регистрации
- Страница авторизации
- Личный кабинет пользователя
- Форма добавления/редактирования контента

Система разделена на 2 основных типа пользователей:
- подписчики
- контентмэйкеры

Контентмэйкеры генерируют контент, подписчики являются его потребителями. Каждый
пользователь может быть и в той и в другой роли.

Контентом может быть всё что угодно: аудио/видео/визуальная/текстовая информация. 
У контентмэйкреа должна быть настраиваемая система распростронения своего контента. Т.е.,
вначале он создает уровни подписки, например:
- Premium: $5
- Standard: $3
- Free
А потом при публикации материала он выбирает уровень его доступности (подписчикам из какой подписки
будет доступен материал).

Подписчики выбирают понравившегося контент-мэйкера и выбирают понравишуюся им подписку.
После чего в своей ленте видять весь контент появляющийся по их подпискам. 