Feature: consultafipe
  In order to find car price
  As a user
  I need to send a car brand and model

Scenario Outline: Buscando Endereço pelo Nome
  Given i have a car with name "<name>"$
  When i call find_price
  Then i see the price is "<price>"$

Examples:
    | name  | price |
    | Toyota/Corolla Fielder SW SE-G 1.8 Flex 16V Aut  | R$ 30.604,00    |
    | MIURA/Picape BG-Truck CD Turbo Diesel   | R$ 27.321,00    |