import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class AKMCustomPage5Fields extends Component {
  
  static slug = 'akm_custom_page_5_fields';

  render() {
    const {
      title,
      subtitle,
      book_author,
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
        <h3 className="book_author">{book_author}</h3>
				<img decoding="async" src={icon} alt="Icon"/>
				<div className="content"><Content /></div>
				<br/><a className="button-primary">{button_text}</a>
			</div>
    );
}
}

export default AKMCustomPage5Fields;
