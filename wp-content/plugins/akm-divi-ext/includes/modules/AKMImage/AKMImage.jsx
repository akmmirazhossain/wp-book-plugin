// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class AKMImage extends Component {

  static slug = 'akmde_akmimage';

  render() {
    return (
      <div className="">
        {this.props.content()}
      </div>
    );
  }
}

export default AKMImage;