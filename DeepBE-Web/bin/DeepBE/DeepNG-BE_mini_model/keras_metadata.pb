
��root"_tf_keras_network*��{"name": "model", "trainable": true, "expects_training_arg": true, "dtype": "float32", "batch_input_shape": null, "must_restore_from_config": false, "class_name": "Functional", "config": {"name": "model", "layers": [{"class_name": "InputLayer", "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_freq"}, "name": "input_1_freq", "inbound_nodes": []}, {"class_name": "Conv1D", "config": {"name": "conv1d_freq", "trainable": false, "dtype": "float32", "filters": 1024, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "conv1d_freq", "inbound_nodes": [[["input_1_freq", 0, 0, {}]]]}, {"class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_freq", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "name": "average_pooling1d_freq", "inbound_nodes": [[["conv1d_freq", 0, 0, {}]]]}, {"class_name": "InputLayer", "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_pattern"}, "name": "input_1_pattern", "inbound_nodes": []}, {"class_name": "Flatten", "config": {"name": "flatten_freq", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "name": "flatten_freq", "inbound_nodes": [[["average_pooling1d_freq", 0, 0, {}]]]}, {"class_name": "Conv1D", "config": {"name": "conv1d_pattern", "trainable": false, "dtype": "float32", "filters": 256, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "conv1d_pattern", "inbound_nodes": [[["input_1_pattern", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_freq", "inbound_nodes": [[["flatten_freq", 0, 0, {}]]]}, {"class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_pattern", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "name": "average_pooling1d_pattern", "inbound_nodes": [[["conv1d_pattern", 0, 0, {}]]]}, {"class_name": "Dropout", "config": {"name": "dropout_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_freq", "inbound_nodes": [[["dense_freq", 0, 0, {}]]]}, {"class_name": "Flatten", "config": {"name": "flatten_pattern", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "name": "flatten_pattern", "inbound_nodes": [[["average_pooling1d_pattern", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_1_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_1_freq", "inbound_nodes": [[["dropout_freq", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_pattern", "trainable": false, "dtype": "float32", "units": 2500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_pattern", "inbound_nodes": [[["flatten_pattern", 0, 0, {}]]]}, {"class_name": "Dropout", "config": {"name": "dropout_1_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_1_freq", "inbound_nodes": [[["dense_1_freq", 0, 0, {}]]]}, {"class_name": "Dropout", "config": {"name": "dropout_pattern", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_pattern", "inbound_nodes": [[["dense_pattern", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_2_freq", "trainable": false, "dtype": "float32", "units": 100, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_2_freq", "inbound_nodes": [[["dropout_1_freq", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_1_pattern", "trainable": false, "dtype": "float32", "units": 256, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_1_pattern", "inbound_nodes": [[["dropout_pattern", 0, 0, {}]]]}, {"class_name": "Dropout", "config": {"name": "dropout_2_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_2_freq", "inbound_nodes": [[["dense_2_freq", 0, 0, {}]]]}, {"class_name": "Dropout", "config": {"name": "dropout_1_pattern", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_1_pattern", "inbound_nodes": [[["dense_1_pattern", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_3_freq", "trainable": false, "dtype": "float32", "units": 1, "activation": "linear", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_3_freq", "inbound_nodes": [[["dropout_2_freq", 0, 0, {}]]]}, {"class_name": "Dense", "config": {"name": "dense_2_pattern", "trainable": false, "dtype": "float32", "units": 31, "activation": "softmax", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}}, "bias_initializer": {"class_name": "Zeros", "config": {}}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_2_pattern", "inbound_nodes": [[["dropout_1_pattern", 0, 0, {}]]]}, {"class_name": "Multiply", "config": {"name": "Multiply", "trainable": true, "dtype": "float32"}, "name": "Multiply", "inbound_nodes": [[["dense_3_freq", 0, 0, {}], ["dense_2_pattern", 0, 0, {}]]]}], "input_layers": [["input_1_freq", 0, 0], ["input_1_pattern", 0, 0]], "output_layers": [["Multiply", 0, 0]]}, "shared_object_id": 39, "input_spec": [{"class_name": "InputSpec", "config": {"dtype": null, "shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "ndim": 3, "max_ndim": null, "min_ndim": null, "axes": {}}}, {"class_name": "InputSpec", "config": {"dtype": null, "shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "ndim": 3, "max_ndim": null, "min_ndim": null, "axes": {}}}], "build_input_shape": [{"class_name": "TensorShape", "items": [null, 30, 4]}, {"class_name": "TensorShape", "items": [null, 30, 4]}], "is_graph_network": true, "full_save_spec": {"class_name": "__tuple__", "items": [[[{"class_name": "TypeSpec", "type_spec": "tf.TensorSpec", "serialized": [{"class_name": "TensorShape", "items": [null, 30, 4]}, "float32", "input_1"]}, {"class_name": "TypeSpec", "type_spec": "tf.TensorSpec", "serialized": [{"class_name": "TensorShape", "items": [null, 30, 4]}, "float32", "input_1"]}]], {}]}, "save_spec": [{"class_name": "TypeSpec", "type_spec": "tf.TensorSpec", "serialized": [{"class_name": "TensorShape", "items": [null, 30, 4]}, "float32", "input_1"]}, {"class_name": "TypeSpec", "type_spec": "tf.TensorSpec", "serialized": [{"class_name": "TensorShape", "items": [null, 30, 4]}, "float32", "input_1"]}], "keras_version": "2.6.0", "backend": "tensorflow", "model_config": {"class_name": "Functional", "config": {"name": "model", "layers": [{"class_name": "InputLayer", "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_freq"}, "name": "input_1_freq", "inbound_nodes": [], "shared_object_id": 0}, {"class_name": "Conv1D", "config": {"name": "conv1d_freq", "trainable": false, "dtype": "float32", "filters": 1024, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 1}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 2}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "conv1d_freq", "inbound_nodes": [[["input_1_freq", 0, 0, {}]]], "shared_object_id": 3}, {"class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_freq", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "name": "average_pooling1d_freq", "inbound_nodes": [[["conv1d_freq", 0, 0, {}]]], "shared_object_id": 4}, {"class_name": "InputLayer", "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_pattern"}, "name": "input_1_pattern", "inbound_nodes": [], "shared_object_id": 5}, {"class_name": "Flatten", "config": {"name": "flatten_freq", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "name": "flatten_freq", "inbound_nodes": [[["average_pooling1d_freq", 0, 0, {}]]], "shared_object_id": 6}, {"class_name": "Conv1D", "config": {"name": "conv1d_pattern", "trainable": false, "dtype": "float32", "filters": 256, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 7}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 8}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "conv1d_pattern", "inbound_nodes": [[["input_1_pattern", 0, 0, {}]]], "shared_object_id": 9}, {"class_name": "Dense", "config": {"name": "dense_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 10}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 11}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_freq", "inbound_nodes": [[["flatten_freq", 0, 0, {}]]], "shared_object_id": 12}, {"class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_pattern", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "name": "average_pooling1d_pattern", "inbound_nodes": [[["conv1d_pattern", 0, 0, {}]]], "shared_object_id": 13}, {"class_name": "Dropout", "config": {"name": "dropout_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_freq", "inbound_nodes": [[["dense_freq", 0, 0, {}]]], "shared_object_id": 14}, {"class_name": "Flatten", "config": {"name": "flatten_pattern", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "name": "flatten_pattern", "inbound_nodes": [[["average_pooling1d_pattern", 0, 0, {}]]], "shared_object_id": 15}, {"class_name": "Dense", "config": {"name": "dense_1_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 16}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 17}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_1_freq", "inbound_nodes": [[["dropout_freq", 0, 0, {}]]], "shared_object_id": 18}, {"class_name": "Dense", "config": {"name": "dense_pattern", "trainable": false, "dtype": "float32", "units": 2500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 19}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 20}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_pattern", "inbound_nodes": [[["flatten_pattern", 0, 0, {}]]], "shared_object_id": 21}, {"class_name": "Dropout", "config": {"name": "dropout_1_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_1_freq", "inbound_nodes": [[["dense_1_freq", 0, 0, {}]]], "shared_object_id": 22}, {"class_name": "Dropout", "config": {"name": "dropout_pattern", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_pattern", "inbound_nodes": [[["dense_pattern", 0, 0, {}]]], "shared_object_id": 23}, {"class_name": "Dense", "config": {"name": "dense_2_freq", "trainable": false, "dtype": "float32", "units": 100, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 24}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 25}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_2_freq", "inbound_nodes": [[["dropout_1_freq", 0, 0, {}]]], "shared_object_id": 26}, {"class_name": "Dense", "config": {"name": "dense_1_pattern", "trainable": false, "dtype": "float32", "units": 256, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 27}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 28}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_1_pattern", "inbound_nodes": [[["dropout_pattern", 0, 0, {}]]], "shared_object_id": 29}, {"class_name": "Dropout", "config": {"name": "dropout_2_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_2_freq", "inbound_nodes": [[["dense_2_freq", 0, 0, {}]]], "shared_object_id": 30}, {"class_name": "Dropout", "config": {"name": "dropout_1_pattern", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "name": "dropout_1_pattern", "inbound_nodes": [[["dense_1_pattern", 0, 0, {}]]], "shared_object_id": 31}, {"class_name": "Dense", "config": {"name": "dense_3_freq", "trainable": false, "dtype": "float32", "units": 1, "activation": "linear", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 32}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 33}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_3_freq", "inbound_nodes": [[["dropout_2_freq", 0, 0, {}]]], "shared_object_id": 34}, {"class_name": "Dense", "config": {"name": "dense_2_pattern", "trainable": false, "dtype": "float32", "units": 31, "activation": "softmax", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 35}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 36}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "name": "dense_2_pattern", "inbound_nodes": [[["dropout_1_pattern", 0, 0, {}]]], "shared_object_id": 37}, {"class_name": "Multiply", "config": {"name": "Multiply", "trainable": true, "dtype": "float32"}, "name": "Multiply", "inbound_nodes": [[["dense_3_freq", 0, 0, {}], ["dense_2_pattern", 0, 0, {}]]], "shared_object_id": 38}], "input_layers": [["input_1_freq", 0, 0], ["input_1_pattern", 0, 0]], "output_layers": [["Multiply", 0, 0]]}}, "training_config": {"loss": "mean_absolute_error", "metrics": null, "weighted_metrics": null, "loss_weights": null, "optimizer_config": {"class_name": "Adam", "config": {"name": "Adam", "learning_rate": 9.999999747378752e-05, "decay": 0.0, "beta_1": 0.8999999761581421, "beta_2": 0.9990000128746033, "epsilon": 1e-07, "amsgrad": false}}}}2
�root.layer-0"_tf_keras_input_layer*�{"class_name": "InputLayer", "name": "input_1_freq", "dtype": "float32", "sparse": false, "ragged": false, "batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_freq"}}2
�	root.layer_with_weights-0"_tf_keras_layer*�	{"name": "conv1d_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Conv1D", "config": {"name": "conv1d_freq", "trainable": false, "dtype": "float32", "filters": 1024, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 1}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 2}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["input_1_freq", 0, 0, {}]]], "shared_object_id": 3, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 3, "axes": {"-1": 4}}, "shared_object_id": 42}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 30, 4]}}2
�root.layer-2"_tf_keras_layer*�{"name": "average_pooling1d_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_freq", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "inbound_nodes": [[["conv1d_freq", 0, 0, {}]]], "shared_object_id": 4, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": 3, "max_ndim": null, "min_ndim": null, "axes": {}}, "shared_object_id": 43}}2
�root.layer-3"_tf_keras_input_layer*�{"class_name": "InputLayer", "name": "input_1_pattern", "dtype": "float32", "sparse": false, "ragged": false, "batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "config": {"batch_input_shape": {"class_name": "__tuple__", "items": [null, 30, 4]}, "dtype": "float32", "sparse": false, "ragged": false, "name": "input_1_pattern"}}2
�root.layer-4"_tf_keras_layer*�{"name": "flatten_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Flatten", "config": {"name": "flatten_freq", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "inbound_nodes": [[["average_pooling1d_freq", 0, 0, {}]]], "shared_object_id": 6, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 1, "axes": {}}, "shared_object_id": 44}}2
�	root.layer_with_weights-1"_tf_keras_layer*�	{"name": "conv1d_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Conv1D", "config": {"name": "conv1d_pattern", "trainable": false, "dtype": "float32", "filters": 256, "kernel_size": {"class_name": "__tuple__", "items": [3]}, "strides": {"class_name": "__tuple__", "items": [1]}, "padding": "same", "data_format": "channels_last", "dilation_rate": {"class_name": "__tuple__", "items": [1]}, "groups": 1, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 7}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 8}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["input_1_pattern", 0, 0, {}]]], "shared_object_id": 9, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 3, "axes": {"-1": 4}}, "shared_object_id": 45}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 30, 4]}}2
�root.layer_with_weights-2"_tf_keras_layer*�{"name": "dense_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 10}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 11}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["flatten_freq", 0, 0, {}]]], "shared_object_id": 12, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 30720}}, "shared_object_id": 46}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 30720]}}2
�root.layer-7"_tf_keras_layer*�{"name": "average_pooling1d_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "AveragePooling1D", "config": {"name": "average_pooling1d_pattern", "trainable": false, "dtype": "float32", "strides": {"class_name": "__tuple__", "items": [1]}, "pool_size": {"class_name": "__tuple__", "items": [1]}, "padding": "valid", "data_format": "channels_last"}, "inbound_nodes": [[["conv1d_pattern", 0, 0, {}]]], "shared_object_id": 13, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": 3, "max_ndim": null, "min_ndim": null, "axes": {}}, "shared_object_id": 47}}2
�	root.layer-8"_tf_keras_layer*�{"name": "dropout_freq", "trainable": false, "expects_training_arg": true, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dropout", "config": {"name": "dropout_freq", "trainable": false, "dtype": "float32", "rate": 0.3, "noise_shape": null, "seed": null}, "inbound_nodes": [[["dense_freq", 0, 0, {}]]], "shared_object_id": 14}2
�
root.layer-9"_tf_keras_layer*�{"name": "flatten_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Flatten", "config": {"name": "flatten_pattern", "trainable": false, "dtype": "float32", "data_format": "channels_last"}, "inbound_nodes": [[["average_pooling1d_pattern", 0, 0, {}]]], "shared_object_id": 15, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 1, "axes": {}}, "shared_object_id": 48}}2
�root.layer_with_weights-3"_tf_keras_layer*�{"name": "dense_1_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_1_freq", "trainable": false, "dtype": "float32", "units": 1500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 16}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 17}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["dropout_freq", 0, 0, {}]]], "shared_object_id": 18, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 1500}}, "shared_object_id": 49}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 1500]}}2
�root.layer_with_weights-4"_tf_keras_layer*�{"name": "dense_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_pattern", "trainable": false, "dtype": "float32", "units": 2500, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 19}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 20}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["flatten_pattern", 0, 0, {}]]], "shared_object_id": 21, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 7680}}, "shared_object_id": 50}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 7680]}}2
�
�
�root.layer_with_weights-5"_tf_keras_layer*�{"name": "dense_2_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_2_freq", "trainable": false, "dtype": "float32", "units": 100, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 24}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 25}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["dropout_1_freq", 0, 0, {}]]], "shared_object_id": 26, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 1500}}, "shared_object_id": 51}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 1500]}}2
�root.layer_with_weights-6"_tf_keras_layer*�{"name": "dense_1_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_1_pattern", "trainable": false, "dtype": "float32", "units": 256, "activation": "relu", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 27}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 28}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["dropout_pattern", 0, 0, {}]]], "shared_object_id": 29, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 2500}}, "shared_object_id": 52}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 2500]}}2
�
�
�root.layer_with_weights-7"_tf_keras_layer*�{"name": "dense_3_freq", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_3_freq", "trainable": false, "dtype": "float32", "units": 1, "activation": "linear", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 32}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 33}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["dropout_2_freq", 0, 0, {}]]], "shared_object_id": 34, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 100}}, "shared_object_id": 53}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 100]}}2
�root.layer_with_weights-8"_tf_keras_layer*�{"name": "dense_2_pattern", "trainable": false, "expects_training_arg": false, "dtype": "float32", "batch_input_shape": null, "stateful": false, "must_restore_from_config": false, "class_name": "Dense", "config": {"name": "dense_2_pattern", "trainable": false, "dtype": "float32", "units": 31, "activation": "softmax", "use_bias": true, "kernel_initializer": {"class_name": "GlorotUniform", "config": {"seed": null}, "shared_object_id": 35}, "bias_initializer": {"class_name": "Zeros", "config": {}, "shared_object_id": 36}, "kernel_regularizer": null, "bias_regularizer": null, "activity_regularizer": null, "kernel_constraint": null, "bias_constraint": null}, "inbound_nodes": [[["dropout_1_pattern", 0, 0, {}]]], "shared_object_id": 37, "input_spec": {"class_name": "InputSpec", "config": {"dtype": null, "shape": null, "ndim": null, "max_ndim": null, "min_ndim": 2, "axes": {"-1": 256}}, "shared_object_id": 54}, "build_input_shape": {"class_name": "TensorShape", "items": [null, 256]}}2
�
��root.keras_api.metrics.0"_tf_keras_metric*�{"class_name": "Mean", "name": "loss", "dtype": "float32", "config": {"name": "loss", "dtype": "float32"}, "shared_object_id": 55}2