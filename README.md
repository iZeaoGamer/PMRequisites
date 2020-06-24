# PMRequisites
Essentials for PocketMine-MP

# Still in development!
This plugin is still under heavy development! At the moment, most commands are working, and in the future I look to add warps and a teleportation system.

# Features

## Commands and Permissions

- /adventure => pmrequisites.adventure
- /break => pmrequisites.break
- /broadcast => pmrequisites.broadcast
- /clearhotbar => pmrequities.clearhotbar
- /clearinventory => pmrequisites.clearinventory
- /clearlag => pmrequisites.clearlag
- /compass => pmrequisites.compass
- /creative => pmrequisites.creative
- /feed => pmrequisites.feed
- /fly => pmrequisites.fly
- /getpos => pmrequisites.getpos
- /heal => pmrequisites.heal
- /nick => pmrequisites.nick
- /ping => pmrequisites.ping
- /repair => pmrequisites.repair
- /setspawn => pmrequisites.setspawn
- **/spawn => pmrequisites.spawn**
- /sudo => pmrequisites.sudo
- /supervanish => pmrequisites.supervanish
- /survival => pmrequisites.survival
- /vanish => pmrequisites.vanish

With SuperVanish, it is supposed to give the effect that the sender has left the server. So, I made it so the player doesn't show in the Player Listings. Sadly, PMMP had no `getLeaveMessage()` or `getJoinMessage()` function, so I had to make a configuration file for the join and leave messages. When you type `/sv` it will send the default join/leave message. You can edit this in the `config.yml` file, to say your server's leave message. I apologize for this inconvenience, but it was the best way I could get this done.

**All permissions should be working, but if you have any issues with my typos or anything, open an issue. Also, I bolded `/spawn` because when a player joins it executes the spawn command, this is temporary, but for now, I recommend setting that as a permission for default ranks**

# Installation
Since this plugin is not officially released on Poggit, you need to download it and either run it from source, or create the `.phar` for it yourself.

## Releases Page

You can download this plugin from the GitHub [releases](https://github.com/HyperFlareMC/PMRequisites/releases) page. Simply download the `.zip` folder, unzip it, then the `.phar` will be waiting for you on the inside. You can then drop it in the `plugins` directory on your server, restart it, and you are good to go!

## Running From Source

` - Click the "Clone or Download" Button,` <br />
` - Grab that link, copy it to your clipboard, and head over to your IDE,`<br />
` - Go to your IDE's Terminal, make sure you are inside of your plugin directory, if not use -> cd .. <- or -> cd plugins <- whatever it takes to get there, and run the command -> git clone <link goes here> <-,` <br />
` - Your plugin is in your plugin's folder! You can now run it from source, or make it into a .phar for distribution. Below is a tutorial on how to make it into a .phar`

## Creating a .phar from Source Code

` - Make sure you have DevTools in your plugins directory, if you don't, head over to -> https://poggit.pmmp.io/p/DevTools/ <- and plop that download to your plugins directory,` <br />
` - Run this command in your Server's Console -> makeplugin PMRequisites <- then, the plugin's .phar will be located in this directory -> /plugin-data/DevTools/PMRequisites.phar <-`

### Common Issues with .phar Creation

One of the most common issues with `.phar` plugin creation is the server telling you that no such files exist when you run the `makeplugin` command. This happens, more than likely, because your schema is set to a `bukkit-plugin`. At least for PhpStorm, this is the default setting. Go head over to the `plugin.yml` file, and if you are in PhpStorm, click in the bottom right where it says `bukkit-plugin`, and scroll through that list until you find `pocketmine-plugin`. Once that is selected, your problem should be solved, just run the `makeplugin` command again.

# SUPPORT

This may seem like a complicated process, but I promise it is not. If you need additional assistance, feel free to open an Issue here on the Repository, or DM me on Discord: `HyperFlare#7018`
