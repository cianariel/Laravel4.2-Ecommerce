<?php
// This file was auto-generated from sdk-root/src/data/firehose/2015-08-04/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2015-08-04', 'endpointPrefix' => 'firehose', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceAbbreviation' => 'Firehose', 'serviceFullName' => 'Amazon Kinesis Firehose', 'signatureVersion' => 'v4', 'targetPrefix' => 'Firehose_20150804', ], 'operations' => [ 'CreateDeliveryStream' => [ 'name' => 'CreateDeliveryStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateDeliveryStreamInput', ], 'output' => [ 'shape' => 'CreateDeliveryStreamOutput', ], 'errors' => [ [ 'shape' => 'InvalidArgumentException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ResourceInUseException', ], ], ], 'DeleteDeliveryStream' => [ 'name' => 'DeleteDeliveryStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteDeliveryStreamInput', ], 'output' => [ 'shape' => 'DeleteDeliveryStreamOutput', ], 'errors' => [ [ 'shape' => 'ResourceInUseException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DescribeDeliveryStream' => [ 'name' => 'DescribeDeliveryStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeDeliveryStreamInput', ], 'output' => [ 'shape' => 'DescribeDeliveryStreamOutput', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], ], ], 'ListDeliveryStreams' => [ 'name' => 'ListDeliveryStreams', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListDeliveryStreamsInput', ], 'output' => [ 'shape' => 'ListDeliveryStreamsOutput', ], ], 'PutRecord' => [ 'name' => 'PutRecord', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutRecordInput', ], 'output' => [ 'shape' => 'PutRecordOutput', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidArgumentException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutRecordBatch' => [ 'name' => 'PutRecordBatch', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutRecordBatchInput', ], 'output' => [ 'shape' => 'PutRecordBatchOutput', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidArgumentException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'UpdateDestination' => [ 'name' => 'UpdateDestination', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateDestinationInput', ], 'output' => [ 'shape' => 'UpdateDestinationOutput', ], 'errors' => [ [ 'shape' => 'InvalidArgumentException', ], [ 'shape' => 'ResourceInUseException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ConcurrentModificationException', ], ], ], ], 'shapes' => [ 'AWSKMSKeyARN' => [ 'type' => 'string', 'max' => 512, 'min' => 1, 'pattern' => 'arn:.*', ], 'BooleanObject' => [ 'type' => 'boolean', ], 'BucketARN' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => 'arn:.*', ], 'BufferingHints' => [ 'type' => 'structure', 'members' => [ 'SizeInMBs' => [ 'shape' => 'SizeInMBs', ], 'IntervalInSeconds' => [ 'shape' => 'IntervalInSeconds', ], ], ], 'CloudWatchLoggingOptions' => [ 'type' => 'structure', 'members' => [ 'Enabled' => [ 'shape' => 'BooleanObject', ], 'LogGroupName' => [ 'shape' => 'LogGroupName', ], 'LogStreamName' => [ 'shape' => 'LogStreamName', ], ], ], 'ClusterJDBCURL' => [ 'type' => 'string', 'min' => 1, 'pattern' => 'jdbc:(redshift|postgresql)://((?!-)[A-Za-z0-9-]{1,63}(?<!-)\\.)+redshift\\.amazonaws\\.com:\\d{1,5}/[a-zA-Z0-9_$]+', ], 'CompressionFormat' => [ 'type' => 'string', 'enum' => [ 'UNCOMPRESSED', 'GZIP', 'ZIP', 'Snappy', ], ], 'ConcurrentModificationException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'CopyCommand' => [ 'type' => 'structure', 'required' => [ 'DataTableName', ], 'members' => [ 'DataTableName' => [ 'shape' => 'DataTableName', ], 'DataTableColumns' => [ 'shape' => 'DataTableColumns', ], 'CopyOptions' => [ 'shape' => 'CopyOptions', ], ], ], 'CopyOptions' => [ 'type' => 'string', ], 'CreateDeliveryStreamInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'S3DestinationConfiguration' => [ 'shape' => 'S3DestinationConfiguration', ], 'RedshiftDestinationConfiguration' => [ 'shape' => 'RedshiftDestinationConfiguration', ], 'ElasticsearchDestinationConfiguration' => [ 'shape' => 'ElasticsearchDestinationConfiguration', ], ], ], 'CreateDeliveryStreamOutput' => [ 'type' => 'structure', 'members' => [ 'DeliveryStreamARN' => [ 'shape' => 'DeliveryStreamARN', ], ], ], 'Data' => [ 'type' => 'blob', 'max' => 1024000, 'min' => 0, ], 'DataTableColumns' => [ 'type' => 'string', ], 'DataTableName' => [ 'type' => 'string', 'min' => 1, ], 'DeleteDeliveryStreamInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], ], ], 'DeleteDeliveryStreamOutput' => [ 'type' => 'structure', 'members' => [], ], 'DeliveryStreamARN' => [ 'type' => 'string', ], 'DeliveryStreamDescription' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', 'DeliveryStreamARN', 'DeliveryStreamStatus', 'VersionId', 'Destinations', 'HasMoreDestinations', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'DeliveryStreamARN' => [ 'shape' => 'DeliveryStreamARN', ], 'DeliveryStreamStatus' => [ 'shape' => 'DeliveryStreamStatus', ], 'VersionId' => [ 'shape' => 'DeliveryStreamVersionId', ], 'CreateTimestamp' => [ 'shape' => 'Timestamp', ], 'LastUpdateTimestamp' => [ 'shape' => 'Timestamp', ], 'Destinations' => [ 'shape' => 'DestinationDescriptionList', ], 'HasMoreDestinations' => [ 'shape' => 'BooleanObject', ], ], ], 'DeliveryStreamName' => [ 'type' => 'string', 'max' => 64, 'min' => 1, 'pattern' => '[a-zA-Z0-9_.-]+', ], 'DeliveryStreamNameList' => [ 'type' => 'list', 'member' => [ 'shape' => 'DeliveryStreamName', ], ], 'DeliveryStreamStatus' => [ 'type' => 'string', 'enum' => [ 'CREATING', 'DELETING', 'ACTIVE', ], ], 'DeliveryStreamVersionId' => [ 'type' => 'string', 'max' => 50, 'min' => 1, 'pattern' => '[0-9]+', ], 'DescribeDeliveryStreamInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'Limit' => [ 'shape' => 'DescribeDeliveryStreamInputLimit', ], 'ExclusiveStartDestinationId' => [ 'shape' => 'DestinationId', ], ], ], 'DescribeDeliveryStreamInputLimit' => [ 'type' => 'integer', 'max' => 10000, 'min' => 1, ], 'DescribeDeliveryStreamOutput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamDescription', ], 'members' => [ 'DeliveryStreamDescription' => [ 'shape' => 'DeliveryStreamDescription', ], ], ], 'DestinationDescription' => [ 'type' => 'structure', 'required' => [ 'DestinationId', ], 'members' => [ 'DestinationId' => [ 'shape' => 'DestinationId', ], 'S3DestinationDescription' => [ 'shape' => 'S3DestinationDescription', ], 'RedshiftDestinationDescription' => [ 'shape' => 'RedshiftDestinationDescription', ], 'ElasticsearchDestinationDescription' => [ 'shape' => 'ElasticsearchDestinationDescription', ], ], ], 'DestinationDescriptionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'DestinationDescription', ], ], 'DestinationId' => [ 'type' => 'string', 'max' => 100, 'min' => 1, ], 'ElasticsearchBufferingHints' => [ 'type' => 'structure', 'members' => [ 'IntervalInSeconds' => [ 'shape' => 'ElasticsearchBufferingIntervalInSeconds', ], 'SizeInMBs' => [ 'shape' => 'ElasticsearchBufferingSizeInMBs', ], ], ], 'ElasticsearchBufferingIntervalInSeconds' => [ 'type' => 'integer', 'max' => 900, 'min' => 60, ], 'ElasticsearchBufferingSizeInMBs' => [ 'type' => 'integer', 'max' => 100, 'min' => 1, ], 'ElasticsearchDestinationConfiguration' => [ 'type' => 'structure', 'required' => [ 'RoleARN', 'DomainARN', 'IndexName', 'TypeName', 'S3Configuration', ], 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'DomainARN' => [ 'shape' => 'ElasticsearchDomainARN', ], 'IndexName' => [ 'shape' => 'ElasticsearchIndexName', ], 'TypeName' => [ 'shape' => 'ElasticsearchTypeName', ], 'IndexRotationPeriod' => [ 'shape' => 'ElasticsearchIndexRotationPeriod', ], 'BufferingHints' => [ 'shape' => 'ElasticsearchBufferingHints', ], 'RetryOptions' => [ 'shape' => 'ElasticsearchRetryOptions', ], 'S3BackupMode' => [ 'shape' => 'ElasticsearchS3BackupMode', ], 'S3Configuration' => [ 'shape' => 'S3DestinationConfiguration', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'ElasticsearchDestinationDescription' => [ 'type' => 'structure', 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'DomainARN' => [ 'shape' => 'ElasticsearchDomainARN', ], 'IndexName' => [ 'shape' => 'ElasticsearchIndexName', ], 'TypeName' => [ 'shape' => 'ElasticsearchTypeName', ], 'IndexRotationPeriod' => [ 'shape' => 'ElasticsearchIndexRotationPeriod', ], 'BufferingHints' => [ 'shape' => 'ElasticsearchBufferingHints', ], 'RetryOptions' => [ 'shape' => 'ElasticsearchRetryOptions', ], 'S3BackupMode' => [ 'shape' => 'ElasticsearchS3BackupMode', ], 'S3DestinationDescription' => [ 'shape' => 'S3DestinationDescription', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'ElasticsearchDestinationUpdate' => [ 'type' => 'structure', 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'DomainARN' => [ 'shape' => 'ElasticsearchDomainARN', ], 'IndexName' => [ 'shape' => 'ElasticsearchIndexName', ], 'TypeName' => [ 'shape' => 'ElasticsearchTypeName', ], 'IndexRotationPeriod' => [ 'shape' => 'ElasticsearchIndexRotationPeriod', ], 'BufferingHints' => [ 'shape' => 'ElasticsearchBufferingHints', ], 'RetryOptions' => [ 'shape' => 'ElasticsearchRetryOptions', ], 'S3Update' => [ 'shape' => 'S3DestinationUpdate', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'ElasticsearchDomainARN' => [ 'type' => 'string', 'max' => 512, 'min' => 1, 'pattern' => 'arn:.*', ], 'ElasticsearchIndexName' => [ 'type' => 'string', 'max' => 80, 'min' => 1, ], 'ElasticsearchIndexRotationPeriod' => [ 'type' => 'string', 'enum' => [ 'NoRotation', 'OneHour', 'OneDay', 'OneWeek', 'OneMonth', ], ], 'ElasticsearchRetryDurationInSeconds' => [ 'type' => 'integer', 'max' => 7200, 'min' => 0, ], 'ElasticsearchRetryOptions' => [ 'type' => 'structure', 'members' => [ 'DurationInSeconds' => [ 'shape' => 'ElasticsearchRetryDurationInSeconds', ], ], ], 'ElasticsearchS3BackupMode' => [ 'type' => 'string', 'enum' => [ 'FailedDocumentsOnly', 'AllDocuments', ], ], 'ElasticsearchTypeName' => [ 'type' => 'string', 'max' => 100, 'min' => 1, ], 'EncryptionConfiguration' => [ 'type' => 'structure', 'members' => [ 'NoEncryptionConfig' => [ 'shape' => 'NoEncryptionConfig', ], 'KMSEncryptionConfig' => [ 'shape' => 'KMSEncryptionConfig', ], ], ], 'ErrorCode' => [ 'type' => 'string', ], 'ErrorMessage' => [ 'type' => 'string', ], 'IntervalInSeconds' => [ 'type' => 'integer', 'max' => 900, 'min' => 60, ], 'InvalidArgumentException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'KMSEncryptionConfig' => [ 'type' => 'structure', 'required' => [ 'AWSKMSKeyARN', ], 'members' => [ 'AWSKMSKeyARN' => [ 'shape' => 'AWSKMSKeyARN', ], ], ], 'LimitExceededException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'ListDeliveryStreamsInput' => [ 'type' => 'structure', 'members' => [ 'Limit' => [ 'shape' => 'ListDeliveryStreamsInputLimit', ], 'ExclusiveStartDeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], ], ], 'ListDeliveryStreamsInputLimit' => [ 'type' => 'integer', 'max' => 10000, 'min' => 1, ], 'ListDeliveryStreamsOutput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamNames', 'HasMoreDeliveryStreams', ], 'members' => [ 'DeliveryStreamNames' => [ 'shape' => 'DeliveryStreamNameList', ], 'HasMoreDeliveryStreams' => [ 'shape' => 'BooleanObject', ], ], ], 'LogGroupName' => [ 'type' => 'string', ], 'LogStreamName' => [ 'type' => 'string', ], 'NoEncryptionConfig' => [ 'type' => 'string', 'enum' => [ 'NoEncryption', ], ], 'NonNegativeIntegerObject' => [ 'type' => 'integer', 'min' => 0, ], 'Password' => [ 'type' => 'string', 'min' => 6, 'sensitive' => true, ], 'Prefix' => [ 'type' => 'string', ], 'PutRecordBatchInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', 'Records', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'Records' => [ 'shape' => 'PutRecordBatchRequestEntryList', ], ], ], 'PutRecordBatchOutput' => [ 'type' => 'structure', 'required' => [ 'FailedPutCount', 'RequestResponses', ], 'members' => [ 'FailedPutCount' => [ 'shape' => 'NonNegativeIntegerObject', ], 'RequestResponses' => [ 'shape' => 'PutRecordBatchResponseEntryList', ], ], ], 'PutRecordBatchRequestEntryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Record', ], 'max' => 500, 'min' => 1, ], 'PutRecordBatchResponseEntry' => [ 'type' => 'structure', 'members' => [ 'RecordId' => [ 'shape' => 'PutResponseRecordId', ], 'ErrorCode' => [ 'shape' => 'ErrorCode', ], 'ErrorMessage' => [ 'shape' => 'ErrorMessage', ], ], ], 'PutRecordBatchResponseEntryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'PutRecordBatchResponseEntry', ], 'max' => 500, 'min' => 1, ], 'PutRecordInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', 'Record', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'Record' => [ 'shape' => 'Record', ], ], ], 'PutRecordOutput' => [ 'type' => 'structure', 'required' => [ 'RecordId', ], 'members' => [ 'RecordId' => [ 'shape' => 'PutResponseRecordId', ], ], ], 'PutResponseRecordId' => [ 'type' => 'string', 'min' => 1, ], 'Record' => [ 'type' => 'structure', 'required' => [ 'Data', ], 'members' => [ 'Data' => [ 'shape' => 'Data', ], ], ], 'RedshiftDestinationConfiguration' => [ 'type' => 'structure', 'required' => [ 'RoleARN', 'ClusterJDBCURL', 'CopyCommand', 'Username', 'Password', 'S3Configuration', ], 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'ClusterJDBCURL' => [ 'shape' => 'ClusterJDBCURL', ], 'CopyCommand' => [ 'shape' => 'CopyCommand', ], 'Username' => [ 'shape' => 'Username', ], 'Password' => [ 'shape' => 'Password', ], 'S3Configuration' => [ 'shape' => 'S3DestinationConfiguration', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'RedshiftDestinationDescription' => [ 'type' => 'structure', 'required' => [ 'RoleARN', 'ClusterJDBCURL', 'CopyCommand', 'Username', 'S3DestinationDescription', ], 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'ClusterJDBCURL' => [ 'shape' => 'ClusterJDBCURL', ], 'CopyCommand' => [ 'shape' => 'CopyCommand', ], 'Username' => [ 'shape' => 'Username', ], 'S3DestinationDescription' => [ 'shape' => 'S3DestinationDescription', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'RedshiftDestinationUpdate' => [ 'type' => 'structure', 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'ClusterJDBCURL' => [ 'shape' => 'ClusterJDBCURL', ], 'CopyCommand' => [ 'shape' => 'CopyCommand', ], 'Username' => [ 'shape' => 'Username', ], 'Password' => [ 'shape' => 'Password', ], 'S3Update' => [ 'shape' => 'S3DestinationUpdate', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'ResourceInUseException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'RoleARN' => [ 'type' => 'string', 'max' => 512, 'min' => 1, 'pattern' => 'arn:.*', ], 'S3DestinationConfiguration' => [ 'type' => 'structure', 'required' => [ 'RoleARN', 'BucketARN', ], 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'BucketARN' => [ 'shape' => 'BucketARN', ], 'Prefix' => [ 'shape' => 'Prefix', ], 'BufferingHints' => [ 'shape' => 'BufferingHints', ], 'CompressionFormat' => [ 'shape' => 'CompressionFormat', ], 'EncryptionConfiguration' => [ 'shape' => 'EncryptionConfiguration', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'S3DestinationDescription' => [ 'type' => 'structure', 'required' => [ 'RoleARN', 'BucketARN', 'BufferingHints', 'CompressionFormat', 'EncryptionConfiguration', ], 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'BucketARN' => [ 'shape' => 'BucketARN', ], 'Prefix' => [ 'shape' => 'Prefix', ], 'BufferingHints' => [ 'shape' => 'BufferingHints', ], 'CompressionFormat' => [ 'shape' => 'CompressionFormat', ], 'EncryptionConfiguration' => [ 'shape' => 'EncryptionConfiguration', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'S3DestinationUpdate' => [ 'type' => 'structure', 'members' => [ 'RoleARN' => [ 'shape' => 'RoleARN', ], 'BucketARN' => [ 'shape' => 'BucketARN', ], 'Prefix' => [ 'shape' => 'Prefix', ], 'BufferingHints' => [ 'shape' => 'BufferingHints', ], 'CompressionFormat' => [ 'shape' => 'CompressionFormat', ], 'EncryptionConfiguration' => [ 'shape' => 'EncryptionConfiguration', ], 'CloudWatchLoggingOptions' => [ 'shape' => 'CloudWatchLoggingOptions', ], ], ], 'ServiceUnavailableException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, 'fault' => true, ], 'SizeInMBs' => [ 'type' => 'integer', 'max' => 128, 'min' => 1, ], 'Timestamp' => [ 'type' => 'timestamp', ], 'UpdateDestinationInput' => [ 'type' => 'structure', 'required' => [ 'DeliveryStreamName', 'CurrentDeliveryStreamVersionId', 'DestinationId', ], 'members' => [ 'DeliveryStreamName' => [ 'shape' => 'DeliveryStreamName', ], 'CurrentDeliveryStreamVersionId' => [ 'shape' => 'DeliveryStreamVersionId', ], 'DestinationId' => [ 'shape' => 'DestinationId', ], 'S3DestinationUpdate' => [ 'shape' => 'S3DestinationUpdate', ], 'RedshiftDestinationUpdate' => [ 'shape' => 'RedshiftDestinationUpdate', ], 'ElasticsearchDestinationUpdate' => [ 'shape' => 'ElasticsearchDestinationUpdate', ], ], ], 'UpdateDestinationOutput' => [ 'type' => 'structure', 'members' => [], ], 'Username' => [ 'type' => 'string', 'min' => 1, 'sensitive' => true, ], ],];
