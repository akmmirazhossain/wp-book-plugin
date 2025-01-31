// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class HelloWorld extends Component {
  
  static slug = 'myex_hello_world';

  render() {
    const {
      title,
      subtitle,
      content: Content,
      icon,
      button_text,
      button_url,
      button_style,
    } = this.props;

    // Determine button style class
    let buttonClass = '';
    switch (button_style) {
      case 'primary':
        buttonClass = 'button-primary';
        break;
      case 'secondary':
        buttonClass = 'button-secondary';
        break;
      default:
        buttonClass = 'button-default';
        break;
    }

    return (
      //const { title, subtitle, content: Content, icon, button_text } = this.props;

      <div>
				<h1 className="title">{title}</h1>
				<h3 className="subtitle">{subtitle}</h3>
				<img decoding="async" src={icon} alt="Icon"/>
				<div className="content"><Content /></div>
				<br/><a className="button-primary">{button_text}</a>
			</div>
    );
}
}

export default HelloWorld;
