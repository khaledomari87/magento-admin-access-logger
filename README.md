# Magento Admin Access Logger
Log all admin actions for Magento 1, relies on "controller_action_predispatch" event.

## Request Logged Data:
- user_id.
- username
- controller_module.
- controller_name.
- action_name.
- parameters.
- A Cronjob to clean old records.

## Screenshots

### Configurations page:
![3](https://user-images.githubusercontent.com/927899/47424416-50766900-d790-11e8-910e-6ac21c679315.png)

### Grid
![1](https://user-images.githubusercontent.com/927899/47424400-49e7f180-d790-11e8-89b7-75ae21e1d42e.png)

### Parameters
![2](https://user-images.githubusercontent.com/927899/47424409-4eaca580-d790-11e8-8195-369adaf10f6a.png)
