# NickUI

![NickUI Banner](https://i.ibb.co/DzBckd1/image.png)

**NickUI** is a feature-rich plugin for PocketMine-MP servers that empowers players to personalize their in-game experience by changing their display names and ranks through an elegant and interactive user interface. Whether you want to stand out with a unique nickname or manage ranks seamlessly, NickUI provides the tools you need to enhance your server's community and engagement.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Commands](#commands)
- [Permissions](#permissions)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [Download on Poggit](#download-on-poggit)

## Features

- **Interactive UI:** Players can easily change their nicknames and select ranks via a user-friendly form.
- **Random Name Selection:** Allows players to assign themselves a random name from a predefined list.
- **Rank Management:** Integrates with ranks, displaying appropriate prefixes alongside nicknames.
- **Real Name Retrieval:** Admins can view a player's real name if they've been nicked.
- **Data Persistence:** Nicknames and ranks are saved persistently, ensuring consistency across server restarts.
- **Customization:** Fully customizable through the `config.yml` file, allowing server owners to tailor the experience to their needs.

## Requirements

- **PocketMine-MP:** Ensure you have the latest version of PocketMine-MP installed.
- **FormAPI by jojoe77777:** NickUI relies on FormAPI for the graphical user interface.

## Installation

1. **Download NickUI:**
   - [Download the latest version](https://poggit.pmmp.io/p/NickUI) of NickUI from Poggit.

2. **Install FormAPI:**
   - [Download FormAPI](https://poggit.pmmp.io/p/FormAPI) by jojoe77777.
   - Place the `FormAPI.phar` file into your server's `plugins/` directory.

3. **Install NickUI:**
   - Place the `NickUI.phar` (or extracted `NickUI` folder) into the `plugins/` directory of your PocketMine-MP server.

4. **Restart Your Server:**
   - Restart the PocketMine-MP server to load both FormAPI and NickUI.

## Commands

NickUI provides the following commands for both players and admins:

### `/nick`

**Description:** Opens the NickUI interface for players to change their display name and rank.

**Usage:** `/nick`

**Permissions:** `nickui.cmd.nick`

### `/unnick`

**Description:** Reverts the player's display name to their real name and default rank.

**Usage:** `/unnick`

**Permissions:** `nickui.cmd.unnick`

### `/realname <player>`

**Description:** Allows admins to view the real name of a player who has set a nickname.

**Usage:** `/realname <player>`

**Permissions:** `nickui.cmd.realname`

## Permissions

Manage access to NickUI's commands and features using the following permissions:

| Permission               | Description                                   | Default |
|--------------------------|-----------------------------------------------|---------|
| `nickui.cmd.nick`        | Allows players to use the `/nick` command      | OP      |
| `nickui.cmd.unnick`      | Allows players to use the `/unnick` command    | OP      |
| `nickui.cmd.realname`    | Allows admins to use the `/realname` command   | OP      |

**Note:** You can adjust these permissions using a permissions plugin like LuckPerms to grant or restrict access as needed.

## Usage

### Changing Your Nickname and Rank

1. **Execute the Command:**
   - In-game, type `/nick` to open the NickUI interface.

2. **Fill Out the Form:**
   - **Enter Your New Name:** Input your desired display name. To select a random name, type `random`.
   - **Select Your Rank:** Choose a rank from the dropdown menu.

3. **Submit the Form:**
   - Click the submit button to apply your changes.

4. **Confirmation:**
   - You will receive a message confirming your nickname and rank change.

### Reverting to Your Real Name

1. **Execute the Command:**
   - In-game, type `/unnick` to revert your display name to your real name and default rank.

2. **Confirmation:**
   - You will receive a message confirming the reversion.

### Viewing a Player's Real Name

1. **Execute the Command:**
   - As an admin, type `/realname <player>` to view the real name of a player with a nickname.

2. **Result:**
   - A message will display the player's real name if they have set a nickname.

## Screenshots

### `/nick`

![NickUI Form](https://i.ibb.co/PgzpzTZ/image.png)

### `/unnick`

![Unnick Confirmation](https://i.ibb.co/SNFF6x6/image.png)

## Troubleshooting

### Common Issues

#### 1. **Form Not Displaying Correctly**

- **Cause:** Ensure that FormAPI is correctly installed and loaded before NickUI.
- **Solution:** Verify that `FormAPI.phar` is in the `plugins/` directory and that there are no errors in the server logs related to FormAPI.

#### 2. **Commands Not Working**

- **Cause:** Missing permissions or incorrect command usage.
- **Solution:** Check that the player has the necessary permissions (`nickui.cmd.nick`, `nickui.cmd.unnick`, `nickui.cmd.realname`). Use a permissions plugin like LuckPerms to assign permissions appropriately.

#### 3. **Nicknames Not Persisting**

- **Cause:** Data not being saved correctly to `config.yml`.
- **Solution:** Ensure the server shuts down gracefully to allow the `onDisable` method to save data. Check file permissions to ensure the server can write to `config.yml`.

### Error Logs

If you encounter any errors, check the server logs located in the `logs/` directory. Look for lines related to `NickUI` or `FormAPI` to identify and resolve issues.

## Contributing

Contributions are welcome! If you'd like to contribute to NickUI, please follow these guidelines:

1. **Fork the Repository:**
   - Click the "Fork" button on the repository page to create your own copy.

2. **Create a Branch:**
   - Make a new branch for your feature or bugfix.

3. **Commit Changes:**
   - Make your changes and commit them with clear messages.

4. **Submit a Pull Request:**
   - Open a pull request to propose your changes to the main repository.

## Download on Poggit

You can download the latest version of **NickUI** directly from [Poggit](https://poggit.pmmp.io/p/NickUI).

![Poggit Build Status](https://poggit.pmmp.io/status/NickUI)
